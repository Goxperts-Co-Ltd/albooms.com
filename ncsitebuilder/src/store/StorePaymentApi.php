<?php

use Profis\web\Request;

class StorePaymentApi {
	
	private static $gateway;

	protected function getBuilderRequestData(StoreNavigation $request, $actionId, $signatureFields = array()) {
		header('Access-Control-Allow-Origin: *', true); // allow cross domain requests

		$data = $request->getBodyAsJson();
		if( !$data || !is_object($data) || !isset($data->sig) ) {
			StoreModule::respondWithJson(array(
				"error" => array("code" => 1, "message" => "Bad request")
			));
		}

		$sigCheckStr = StoreModule::$siteInfo->websiteUID . "|" . $actionId;
		foreach ($signatureFields as $k)
			$sigCheckStr .= "|" . $k . "=" . $data->{$k};

		$expectedHash = md5($sigCheckStr);
		$hash = $this->publicDecrypt($data->sig);
		if( $hash !== $expectedHash ) {
			StoreModule::respondWithJson(array(
				"error" => array("code" => 2, "message" => "Bad signature")
			));
		}

		return $data;
	}

	protected function storeLogAction(StoreNavigation $request) {
		$data = $this->getBuilderRequestData($request, 'store-log');

		$list = StoreModuleOrder::findAll(array());
		foreach ($list as $idx => $li) {
			$list[$idx] = $li->jsonSerialize();
		}

		StoreModule::respondWithJson(array("ok" => true, "list" => $list));
	}

	protected function removeOrderAction(StoreNavigation $request) {
		$data = $this->getBuilderRequestData($request, 'remove-order', array("id"));

		$order = StoreModuleOrder::findByTransactionId($data->id);
		if( $order && ($order->getState() == StoreModuleOrder::STATE_PENDING || $order->getState() == StoreModuleOrder::STATE_FAILED || $order->getState() == StoreModuleOrder::STATE_REFUNDED || $order->getState() == StoreModuleOrder::STATE_CANCELLED) )
			$order->delete();

		StoreModule::respondWithJson(array("ok" => true));
	}

	protected function setOrderStateAction(StoreNavigation $request) {
		$data = $this->getBuilderRequestData($request, 'set-order-state', array("id", "state"));

		$order = StoreModuleOrder::findByTransactionId($data->id);
		if( $order )
			$order->setState($data->state)->save();

		StoreModule::respondWithJson(array("ok" => true));
	}

	protected function storeSubmitAction(StoreNavigation $request) {
		$response = array('createFields' => null, 'deleteFields' => array(), 'updateFields' => array(), 'error' => null);
		try {
			$gatewayId = self::getGatewayIdFromRequest($request);
			$data = $request->getBodyAsJson();
			if (!$gatewayId || !is_object($data) || !$data
					|| !isset($data->formData) || !is_array($data->formData) || !$data->formData)
				throw new ErrorException(StoreModule::__('An error occurred. Please try again.'));

			$transactionId = (isset($data->transactionId) && $data->transactionId) ? $data->transactionId : StoreData::randomHash(9, true);

			ob_start();
			$currency = StoreData::getCurrency();
			$priceOptions = StoreData::getPriceOptions();
			$cartData = StoreData::getCartData();
			$totals = (object) array(); StoreCartApi::calcTaxesAndShipping($totals, $cartData);
			$orderPrice = (isset($data->orderPrice) && $data->orderPrice) ? $data->orderPrice : $totals->totalPrice;
			$order = StoreModuleOrder::findByTransactionId($transactionId);
			if (!$order) $order = new StoreModuleOrder();
			$items = StoreCartApi::buildCartItemList($order, $cartData);
			if (empty($items)) {
				throw new ErrorException(StoreModule::__('An error occurred. Please try again later.'));
			}
			$order->setTransactionId($transactionId)
					->setLang($request->getCurrLang())
					->setGatewayId($gatewayId)
					->setItems($items)
					->setPrice(floatval($orderPrice))
					->setBuyer(null)
					->setType('buy')
					->setState(StoreModuleOrder::STATE_PENDING)
					->setCurrency($currency)
					->setPriceOptions($priceOptions)
					->setBillingInfo($cartData->billingInfo)
					->setDeliveryInfo($cartData->deliveryInfo)
					->setOrderComment($cartData->orderComment)
					->setTaxAmount($totals->taxPrice)
					->setShippingAmount($totals->shippingPrice)
					->setShippingDescription($totals->shippingMethod)
					->save();
			$formData = array(); $updateFields = array();
			foreach ($data->formData as $field) {
				if ($field->isPrice) {
					$field->value = $orderPrice;
					$fd = (isset($field->fixedDecimal) && is_numeric($field->fixedDecimal) && $field->fixedDecimal >= 0) ? $field->fixedDecimal : 2;
					$mlp = (isset($field->multiplier) && is_numeric($field->multiplier) && $field->multiplier > 0) ? $field->multiplier : 1;
					$field->value = number_format(($orderPrice * $mlp), $fd, '.', '');
					$updateFields[$field->name] = $field->value;
				} else if ($field->value == '{transactionId}') {
					$field->value = $transactionId;
					$updateFields[$field->name] = $field->value;
				}
				$formData[$field->name] = $field->value;
			}
			$response['updateFields'] = $updateFields;
			$response['orderData'] = array(
				"id" => $order->getId(),
				"transactionId" => $order->getTransactionId(),
				"invoiceUrl" => $order->getInvoiceDocumentNumber() ? self::getInvoiceUrl($request, $order) : null,
			);
			$gateway = self::getGateway($request);
			if ($gateway) {
				$response['createFields'] = $gateway->createFormFields($formData);
				$response['redirectUrl'] = $gateway->createRedirectUrl($formData);
				$response['instantRedirectUrl'] = $gateway->createInstantRedirectUrl($formData);
				$response['backUrl'] = $request->getUrl();
				$response['noSubmit'] = ($response['createFields'] === false);
				$response['error'] = $gateway->getLastError();
				if( !$gateway->isCallbackSupported() ) {
					StoreCartApi::clearStoreCart();
				}
				self::sendOrderEmails($request, $order, false);
			}
			ob_end_clean();
		} catch (ErrorException $ex) {
			$response['error'] = $ex->getMessage();
		}
		StoreModule::respondWithJson($response);
		exit();
	}
	
	/**
	 * Verify function to verify payment from payment system
	 * @param StoreNavigation $request store request descriptor object.
	 */
	protected function storeVerifyAction(StoreNavigation $request) {
		$gateway = self::getGateway($request);
		file_put_contents(dirname(__FILE__).'/store_orders_verify.log', print_r(array(
			'time' => date('Y-m-d H:i:s'),
			'gateway' => self::getGatewayIdFromRequest($request),
			'POST' => $request->getFormParams(),
			'GET' => $request->getQueryParams()
		), true)."\n\n", FILE_APPEND);
		if ($gateway) {
			$order = ($txnId = $gateway->getTransactionId()) ? StoreModuleOrder::findByTransactionId($txnId) : null;
			$gateway->verify($order);
		}
		exit();
	}
	
	/**
	 * Callback function to complete payment from payment system
	 * @param StoreNavigation $request store request descriptor object.
	 */
	protected function storeCallbackAction(StoreNavigation $request) {
		$gateway = self::getGateway($request);
		file_put_contents(dirname(__FILE__).'/store_orders.log', print_r(array(
			'time' => date('Y-m-d H:i:s'),
			'gateway' => self::getGatewayIdFromRequest($request),
			'gatewayOK' => ($gateway ? 'Yes' : 'No'),
			'gatewayTransactionId' => ($gateway ? $gateway->getTransactionId() : null),
			'POST' => $request->getFormParams(),
			'GET' => $request->getQueryParams()
		), true)."\n\n", FILE_APPEND);

		if ($gateway) {
			$clbRes = $gateway->callback(StoreModuleOrder::findByTransactionId($gateway->getTransactionId()));
			if (is_null($clbRes))
				throw new ErrorException('Error: Gateway callback method must return boolean value.');
			if ($clbRes && ($order = StoreModuleOrder::findByTransactionId($gateway->getTransactionId()))) {
				$clbSuccess = true;
				$buyerData = $gateway->getClientInfo();
				if ($buyerData) $order->setBuyer(StoreModuleBuyer::create()->setData($buyerData));
				$order->setCompleteDateTime(date('Y-m-d H:i:s'))
						->setState(StoreModuleOrder::STATE_COMPLETE)
						->save();
				self::sendOrderEmails($request, $order, true);
			} else {
				$clbSuccess = false;
			}
			if ($gateway->doReturnAfterCallback()) {
				if ($clbSuccess) {
					$this->storeReturnAction($request);
				} else {
					$this->storeCancelAction($request);
				}
			}
		}
		exit();
	}

	protected function storeReturnAction(StoreNavigation $request) {
		$gateway = self::getGateway($request);
		if ($gateway) $gateway->completeCheckout();
		if (session_id()) { $_SESSION['store_return'] = true; }
		$backUrl = $request->getFormParam('store_return_backUrl', $request->getQueryParam('store_return_backUrl', $request->getUri()));
		StoreNavigation::redirect($backUrl);
		exit();
	}
	
	protected function storeCancelAction(StoreNavigation $request) {
		$gateway = self::getGateway($request);
		if ($gateway) $gateway->cancel();
		if (session_id()) {
			$_SESSION['store_cancel'] = true;
			$_SESSION['store_cancel_exText'] = $request->getFormParam('exText', $request->getQueryParam('exText'));
		}
		$backUrl = $request->getFormParam('store_cancel_backUrl', $request->getQueryParam('store_cancel_backUrl', $request->getUri()));
		StoreNavigation::redirect($backUrl);
		exit();
	}
	
	private static function gatewayBackMessage($type, $exText = null) {
		if ($type == 'return') {
			StoreCartApi::clearStoreCart();
			$alert = 'success';
			$text = StoreModule::__('Payment has been submitted');
		} else if ($type == 'cancel') {
			$alert = 'danger';
			$text = StoreModule::__('Payment has been canceled');
		}
		if (session_id()) { $sessKey = 'store_'.$type; $_SESSION[$sessKey] = null; unset($_SESSION[$sessKey]); }
		$out = "<script type=\"text/javascript\">".
			"$('<div>')".
				".addClass('alert alert-{$alert}')".
				".css({"
					."position: 'fixed', "
					."right: '10px', "
					."top: '10px', "
					."zIndex: 10000, "
					."fontSize: '24px', "
					."padding: '30px 50px', "
					."lineHeight: '24px', "
					."maxWidth: '748px'"
				."})".
				".append('{$text}')".
				($exText ? ".append('<br />').append($('<span>').css({"
					."fontSize: '14px', "
					."lineHeight: '18px'"
				."}).append('".addslashes($exText)."'))" : "").
				".prepend($('<button>')".
					".addClass('close')".
					".css({marginRight: '-40px', marginTop: '-24px'})".
					".html(\"&nbsp;&times;\")".
					".on('click', function() {".
						"$(this).parent().remove();".
					"})".
				")".
				".appendTo('body');".
			"</script>";
		return $out;
	}
	
	private static function getGatewayIdFromRequest(StoreNavigation $request) {
		$gatewayId = $request->getQueryParam('gatewayId');
		if (!$gatewayId) $gatewayId = $request->getArg(1);
		return $gatewayId;
	}
	
	/**
	 * Get currently used gateway instance
	 * @param StoreNavigation $request store request descriptor object.
	 * @return PaymentGateway|null
	 */
	private static function getGateway(StoreNavigation $request) {
		if (!self::$gateway) {
			$gatewayId = self::getGatewayIdFromRequest($request);
			if ($gatewayId) {
				$cls = 'Gateway'.implode('', array_map('ucfirst', preg_split('#(?:_|\-|(\d))#', $gatewayId, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE)));
				$file = dirname(__FILE__).'/'.$cls.'.php';
				$dfile = dirname(__FILE__).'/PaymentGateway.php';
				if (!is_file($file)) {
					$file = dirname(__FILE__).'/../../'.$cls.'.php';
				}
				if (is_file($file) && is_file($dfile)) {
					$config = isset(StoreModule::$initData->gatewayConfig[$gatewayId]) ? StoreModule::$initData->gatewayConfig[$gatewayId] : null;
					if (!$config || !is_object($config)) $config = new stdClass();
					
					// Note: backwards compatibility, since usage of globals was part of public API.
					if (isset($config->gatewayId) && $config->gatewayId) {
						foreach ($config as $k => $v) {
							$vname = 'store_'.$config->gatewayId.'_'.$k;
							global $$vname;
							$$vname = $v;
						}
					}
					
					$config->wbBaseLang = $request->baseLang;
					$config->wbDefLang = $request->defLang;
					$config->wbLang = $request->lang;
					require_once($dfile);
					require_once($file);
					self::$gateway = new $cls($config);
				}
			}
		}
		return self::$gateway;
	}
	
	/**
	 * Format price according to price options
	 * @param float $price
	 * @return string
	 */
	public static function getFormattedPrice($price) {
		$currency = StoreData::getCurrency();
		$priceOpts = StoreData::getPriceOptions();
		$point = $priceOpts->decimalPoint ? $priceOpts->decimalPoint : '.';
		$places = $priceOpts->decimalPlaces ? $priceOpts->decimalPlaces : 2;
		$thousandsSep = $priceOpts->thousandsSeparator ? $priceOpts->thousandsSeparator : '';
		$prefix = $currency ? $currency->prefix : '';
		$postfix = $currency ? ($currency->postfix ? $currency->postfix : (($currency->code && !$prefix) ? ' '.$currency->code : '')) : '';
		return $prefix . number_format(floatval($price), $places, $point, $thousandsSep) . $postfix;
	}

	private static function getInvoiceUrl(StoreNavigation $request, StoreModuleOrder $order) {
		$lang = $request->lang;
		$request->lang = $request->defLang ? $request->defLang : $request->baseLang;
		$url = $request->getUrl("store-invoice/" . $order->getHash());
		$request->lang = $lang;
		return $url;
	}

	protected static function sendOrderEmails(StoreNavigation $request, StoreModuleOrder $order, $addThankYouText) {
		@set_time_limit(130);
		$subject = $addThankYouText
			? sprintf(StoreModule::__("Payment received for order %s at %s"), '#'.$order->getTransactionId(), StoreModule::$siteInfo->domain)
			: sprintf(StoreModule::__("New order %s at %s"), '#'.$order->getTransactionId(), StoreModule::$siteInfo->domain);
		if (isset(StoreModule::$initData->contactFormId) && StoreModule::$initData->contactFormId) {
			foreach (StoreModule::$siteInfo->forms as $pageForms) {
				foreach ($pageForms as $formId => $form) {
					if ($formId == StoreModule::$initData->contactFormId) {
						$langBackup = $request->lang;
						$langBackupSm = SiteModule::$lang;

						$request->lang = $request->defLang; // Force sending email to seller in default language.
						SiteModule::setLang($request->lang);
						self::sendMail($subject, self::prepareSellerMailBody($request, $subject, $order, $addThankYouText), $form, $request);

						$request->lang = $order->getLang(); // Force sending email to customer in language of the order.
						if( !$request->lang )
							$request->lang = $request->defLang;
						SiteModule::setLang($request->lang);
						$form["email"] = $order->getBillingInfo()->email;
						self::sendMail($subject, self::prepareBuyerMailBody($request, $subject, $order, $addThankYouText), $form, $request);

						$request->lang = $langBackup;
						SiteModule::setLang($langBackupSm);
						break 2;
					}
				}
			}
		}
	}


	/**
	 * Generate email body
	 * @param StoreNavigation $request
	 * @param string $title
	 * @param StoreModuleOrder $order
	 * @return string
	 */
	private static function prepareSellerMailBody(StoreNavigation $request, $title, StoreModuleOrder $order, $addThankYouText) {
		return self::renderEmailView($request, dirname(__FILE__).'/view/email-for-seller.php', array(
			"title" => $title,
			"order" => $order,
			"addThankYouText" => $addThankYouText,
			"invoiceUrl" => self::getInvoiceUrl($request, $order),
		));
	}

	/**
	 * Generate email body
	 * @param StoreNavigation $request
	 * @param string $title
	 * @param StoreModuleOrder $order
	 * @param bool $addThankYouText
	 * @return string
	 */
	private static function prepareBuyerMailBody(StoreNavigation $request, $title, StoreModuleOrder $order, $addThankYouText) {
		return self::renderEmailView($request, dirname(__FILE__).'/view/email-for-buyer.php', array(
			"title" => $title,
			"order" => $order,
			"addThankYouText" => $addThankYouText,
			"invoiceUrl" => self::getInvoiceUrl($request, $order),
		));
	}

	private static function renderEmailView(StoreNavigation $request, $viewPath, $vars) {
		extract($vars);

		ob_start();
		include $viewPath;
		$content = ob_get_clean();

		if( !isset($title) && isset($subject) )
			$title = $subject;
		ob_start();
		include $request->basePath.'/src/view/email_layout.php';
		return ob_get_clean();
	}

	public static function buildInfoHtmlTableRows($title, $info) {
		$hasAny = false;
		$rows = array();
		if ($info && (is_array($info) || is_object($info))) {
			foreach ($info as $k => $v) {
				if( empty($v) ) continue;
				$fieldName = self::getInfoHtmlTableFieldName($k);
				if( $fieldName === null ) continue;
				if (!$hasAny) {
					$rows[] = '<tr><td colspan="2"><h3>'.$title.':</h3></td></tr>';
					$hasAny = true;
				}
				$rows[] = '<tr>'.
						'<td><strong>'.$fieldName.':</strong>&nbsp;</td>'.
						'<td>'.htmlspecialchars($v).'</td>'.
					'</tr>';
			}
		} else if (is_string($info)) {
			$hasAny = true;
			$rows[] = '<tr><td colspan="2"><h3>'.$title.':</h3></td></tr>';
			$rows[] = '<tr><td colspan="2">'.$info.'</td></tr>';
		}
		if ($hasAny) $rows[] = '<tr><td colspan="2">&nbsp;</td></tr>';
		return implode("\n", $rows);
	}
	
	public static function getInfoHtmlTableFieldName($k) {
		if( $k === "isCompany" )
			return null;
		
		if ($k === 'email') return StoreModule::__('Email');
		if ($k === 'companyName') return StoreModule::__('Company Name');
		if ($k === 'companyCode') return StoreModule::__('Company Code');
		if ($k === 'companyVatCode') return StoreModule::__('Company TAX/VAT number');
		if ($k === 'firstName') return StoreModule::__('First Name');
		if ($k === 'lastName') return StoreModule::__('Last Name');
		if ($k === 'address1' || $k === 'address2') return StoreModule::__('Address');
		if ($k === 'city') return StoreModule::__('City');
		if ($k === 'region') return StoreModule::__('Region');
		if ($k === 'postCode') return StoreModule::__('Post Code');
		if ($k === 'countryCode') return StoreModule::__('Country Code');
		if ($k === 'country') return StoreModule::__('Country');
		if ($k === 'phone') return StoreModule::__('Phone Number');
		
		return (function_exists('mb_ucfirst') ? mb_ucfirst($k) : ucfirst($k));
	}
	
	/**
	 * Send email to site owner
	 * @param string $subject
	 * @param string $body
	 * @param array $options
	 */
	private static function sendMail($subject, $body, $options, StoreNavigation $request) {
		if (!class_exists('PHPMailer')) {
			include $request->basePath.'/phpmailer/class.phpmailer.php';
		}
		$mailer = new PHPMailer();
		if (isset($options['smtpEnable']) && $options['smtpEnable']) {
			if (!class_exists("SMTP"))
				include $request->basePath.'/phpmailer/class.smtp.php';
			
			$mailer->isSMTP();
			$mailer->Host = ((isset($options['smtpHost']) && $options['smtpHost']) ? $options['smtpHost'] : 'localhost');
			$mailer->Port = ((isset($options['smtpPort']) && intval($options['smtpPort'])) ? intval($options['smtpPort']) : 25);
			$mailer->SMTPSecure = ((isset($options['smtpEncryption']) && $options['smtpEncryption']) ? $options['smtpEncryption'] : '');
			$mailer->SMTPAutoTLS = false;
			if (isset($options['smtpUsername']) && $options['smtpUsername'] && isset($options['smtpPassword']) && $options['smtpPassword']) {
				$mailer->SMTPAuth = true;
				$mailer->Username = ((isset($options['smtpUsername']) && $options['smtpUsername']) ? $options['smtpUsername'] : '');
				$mailer->Password = ((isset($options['smtpPassword']) && $options['smtpPassword']) ? $options['smtpPassword'] : '');
			}
			$mailer->SMTPOptions = array('ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
				'allow_self_signed' => true
			));
		}
		$optsObject = json_decode($options['object'], true);
		$sender_name = $optsObject['sender_name'];
		$sender_email = (isset($options['emailFrom']) && $options['emailFrom']) ? trim($options['emailFrom']) : $optsObject['sender_email'];
		if (preg_match('#^([^<]+|)<([^>]+)>$#', $sender_email, $m)) {
			if (trim($m[1])) $sender_name = trim($m[1]);
			$sender_email = trim($m[2]);
		} else if (preg_match('#^<([^>]+)>(.+|)$#', $sender_email, $m)) {
			if (trim($m[2])) $sender_name = trim($m[2]);
			$sender_email = trim($m[1]);
		}
		$mailer->SetFrom($sender_email, $sender_name);
		$mailTo = array_map('trim', preg_split('#[;,]#', $options['email'], -1, PREG_SPLIT_NO_EMPTY));
		foreach ($mailTo as $eml) {
			if ($eml && ($m = is_mail($eml))) $mailer->AddAddress($m);
		}
		$mailer->CharSet = 'utf-8';
		$mailer->msgHTML($body);
		$mailer->AltBody = strip_tags(str_replace("</tr>", "</tr>\n", preg_replace('#<(style|head).*>.*</\\1>#isuU', '', $body)));
		$mailer->Subject = $subject ? $subject : $options['subject'];
		ob_start();
		$res = $mailer->Send();
		ob_get_clean();
		if (!$res && $mailer->ErrorInfo) {
			error_log('[Form sending error]: '.$mailer->ErrorInfo);
		}
	}
	
	public static function process(StoreNavigation $request, $homePage = false) {
		if ($homePage) {
			$ctrl = new self();
			$key = $request->getArg(0);
			$cartAction = array_map('ucfirst', explode('-', strtolower(preg_replace('#[^a-zA-Z0-9\-]+#', '', $key))));
			$cartAction[0] = strtolower($cartAction[0]);
			$method = implode('', $cartAction).'Action';
			if (method_exists($ctrl, $method)) {
				call_user_func(array($ctrl, $method), $request);
			} else if ($request) {
				$gateway = self::getGateway($request);
				if ($gateway && method_exists($gateway, $key)) {
					StoreModule::respondWithJson(call_user_func(array($gateway, $key)));
				}
			}
		}
		if (session_id() && isset($_SESSION['store_return'])) {
			return self::gatewayBackMessage('return');
		}
		if (session_id() && isset($_SESSION['store_cancel'])) {
			$exText = (isset($_SESSION['store_cancel_exText']) && $_SESSION['store_cancel_exText'])
					? $_SESSION['store_cancel_exText'] : null;
			$_SESSION['store_cancel_exText'] = null;
			unset($_SESSION['store_cancel_exText']);
			return self::gatewayBackMessage('cancel', $exText);
		}
		return null;
	}

	/**
	 * @param string $publicKey
	 * @param string $token
	 * @return TokenVerifyTokenData|null
	 */
	private function decryptToken($publicKey, $token) {
		$data = '';
		$dataParts = str_split(base64_decode($token), 256);
		foreach ($dataParts as $part) {
			$dPart = '';
			if ($this->opensslPublicDecryptPure($part, $dPart, $publicKey) === false) {
				return null;
			}
			$data .= $dPart;
		}
		return TokenVerifyTokenData::fromJson($data);
	}

	private function publicDecrypt($encData) {
		require_once __DIR__.'/../../phpseclib/Crypt/Random.php';
		require_once __DIR__.'/../../phpseclib/Math/BigInteger.php';
		require_once __DIR__.'/../../phpseclib/Crypt/Hash.php';
		require_once __DIR__.'/../../phpseclib/Crypt/RSA.php';
		$rsa = new \phpseclib\Crypt\RSA();
		$rsa->loadKey($this->getSecurityPublicKey());
		$rsa->setEncryptionMode(\phpseclib\Crypt\RSA::ENCRYPTION_PKCS1);
		$data = @$rsa->decrypt(base64_decode($encData));
		return ($data === false) ? null : $data;
	}

	private function publicEncrypt($data) {
		require_once __DIR__.'/../../phpseclib/Crypt/Random.php';
		require_once __DIR__.'/../../phpseclib/Math/BigInteger.php';
		require_once __DIR__.'/../../phpseclib/Crypt/Hash.php';
		require_once __DIR__.'/../../phpseclib/Crypt/RSA.php';
		$rsa = new \phpseclib\Crypt\RSA();
		$rsa->loadKey($this->getSecurityPublicKey());
		$rsa->setEncryptionMode(\phpseclib\Crypt\RSA::ENCRYPTION_PKCS1);
		$encData = @$rsa->encrypt($data);
		return ($encData === false) ? null : base64_encode($encData);
	}

	private function getSecurityPublicKey() {
		return "-----BEGIN PUBLIC KEY-----\n"
		."MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAzeio9jpU3e31Rlc4w0SA\n"
		."jOWOkjS++yZnyaziUDyLXupLxELER2SHyA2nFG7eOuKPohYFomX/GQdtbMLLL+4J\n"
		."/IofyOi1t/jlafY3wzTYCN2u8pfYP6L5sChuE3zb+g7Gvq/1XewiroDChy0mE+zr\n"
		."mATJp+UY2zcc60S0aiv+mFaGHrD6vyK/uUlfd2XbLNjWJnOe4HKq/uZb9MK8yY34\n"
		."snpLzrwmnxjS0/UDvljdrUAA1gIYA8rIO08AiyT9evTQEMyp4861COfGVdASHi/i\n"
		."O5piPRMp1BuY0LYk0ykA79gI7kygk5qQRcHJLZ1jhsm4jHl7chrjJ3jis8Pk4ico\n"
		."KwIDAQAB\n"
		."-----END PUBLIC KEY-----\n";
	}

}
