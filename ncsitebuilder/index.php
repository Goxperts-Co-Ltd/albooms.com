<?php
	if (version_compare(PHP_VERSION, '5.3.0') < 0) {
		echo "Your PHP version is outdated for this website. Please update PHP version to 5.3.6 or higher.";
		exit();
	}
	if (!function_exists('mb_strlen')) {
		echo "PHP extension \"mbstring\" is required for this website. Please enable it.";
		exit();
	}
	error_reporting(E_ALL); @ini_set('display_errors', true);
	if (!@session_id()) @session_start();
	$tz = @date_default_timezone_get(); @date_default_timezone_set($tz ? $tz : 'UTC');
	require_once dirname(__FILE__).'/polyfill.php';
	$pages = array(
		'0'	=> array('id' => '1', 'alias' => '', 'file' => '1.php','controllers' => array()),
		'1'	=> array('id' => '2', 'alias' => 'About-Us', 'file' => '2.php','controllers' => array()),
		'2'	=> array('id' => '4', 'alias' => 'Work-Process', 'file' => '4.php','controllers' => array()),
		'3'	=> array('id' => '5', 'alias' => 'Shopping-Cart', 'file' => '5.php','controllers' => array('store', 'store-cart')),
		'4'	=> array('id' => '3', 'alias' => 'Contacts', 'file' => '3.php','controllers' => array())
	);
	$forms = array(
		'3'	=> array(
			'c0be462c' => Array( 'email' => '', 'emailFrom' => '', 'subject' => 'Enquire from the web page', 'sentMessage' => unserialize('s:14:"Form was sent.";'), 'object' => '', 'objectRenderer' => '', 'loggingHandler' => '', 'smtpEnable' => false, 'smtpHost' => null, 'smtpPort' => null, 'smtpEncryption' => null, 'smtpUsername' => null, 'smtpPassword' => null, 'recSiteKey' => null, 'recSecretKey' => null, 'maxFileSizeTotal' => '2', 'fields' => array( array( 'fidx' => '0', 'name' => 'Name', 'type' => 'input', 'required' => 1, 'options' => '' ), array( 'fidx' => '1', 'name' => 'E-mail', 'type' => 'input', 'required' => 1, 'options' => '' ), array( 'fidx' => '2', 'name' => 'Country', 'type' => 'input', 'required' => 1, 'options' => '' ), array( 'fidx' => '3', 'name' => 'City', 'type' => 'input', 'required' => 1, 'options' => '' ), array( 'fidx' => '4', 'name' => 'Address', 'type' => 'input', 'required' => 1, 'options' => '' ), array( 'fidx' => '5', 'name' => 'Message', 'type' => 'textarea', 'required' => 1, 'options' => '' ) ) )
		),
		'store'	=> array(
			'7309a84a' => Array( 'email' => 'sales@albumfactory.com', 'emailFrom' => '', 'subject' => 'Enquire from the web page', 'sentMessage' => unserialize('s:14:"Form was sent.";'), 'object' => '{"name":"{{name}} (SKU: {{sku}}) (Price: {{price}}) (Qty: {{qty}})"}', 'objectRenderer' => 'StoreModule::renderFormObject', 'loggingHandler' => 'StoreModule::logForm', 'smtpEnable' => false, 'smtpHost' => null, 'smtpPort' => null, 'smtpEncryption' => null, 'smtpUsername' => null, 'smtpPassword' => null, 'recSiteKey' => null, 'recSecretKey' => null, 'maxFileSizeTotal' => '3', 'fields' => array( array( 'fidx' => '0', 'name' => 'Name', 'type' => 'input', 'required' => 1, 'options' => '' ), array( 'fidx' => '1', 'name' => 'E-mail', 'type' => 'input', 'required' => 1, 'options' => '' ), array( 'fidx' => '2', 'name' => 'Address', 'type' => 'input', 'required' => 1, 'options' => '' ), array( 'fidx' => '3', 'name' => 'Comments', 'type' => 'textarea', 'required' => 1, 'options' => '' ) ) )
		),
		'5'	=> array(
			'03ebd2e9' => Array( 'email' => 'sales@albumfactory.com', 'emailFrom' => '', 'subject' => 'Enquire from the web page', 'sentMessage' => unserialize('s:14:"Form was sent.";'), 'object' => '{"sender_name":"Store Notification System","sender_email":"no-reply@albooms.com"}', 'objectRenderer' => 'StoreModule::renderFormObject', 'loggingHandler' => 'StoreModule::logForm', 'smtpEnable' => false, 'smtpHost' => null, 'smtpPort' => null, 'smtpEncryption' => null, 'smtpUsername' => null, 'smtpPassword' => null, 'recSiteKey' => null, 'recSecretKey' => null, 'maxFileSizeTotal' => '3', 'fields' => array( array( 'fidx' => '0', 'name' => 'Name', 'type' => 'input', 'required' => 1, 'options' => '' ), array( 'fidx' => '1', 'name' => 'E-mail', 'type' => 'input', 'required' => 1, 'options' => '' ), array( 'fidx' => '2', 'name' => 'Address', 'type' => 'input', 'required' => 1, 'options' => '' ), array( 'fidx' => '3', 'name' => 'Comments', 'type' => 'textarea', 'required' => 1, 'options' => '' ) ) )
		)
	);
	$langs = null;
	$def_lang = null;
	$base_lang = 'en';
	$site_id = "ee0fddaa";
	$websiteUID = "01af4d42e61a08e5729881f776af713e2298f1b9a986266983a5521ca0ac7b12fac96d4036180595";
	$base_dir = dirname(__FILE__);
	$base_url = '/';
	$user_domain = 'albooms.com';
	$home_page = '1';
	$mod_rewrite = true;
	$show_comments = false;
	$comment_callback = "https://sitebuilder1.web-hosting.com:443/comment_callback/";
	$user_key = "j77qA3uLcEwNb3c=";
	$user_hash = "f3a6fcb5669722e0";
	$ga_code = (is_file($ga_code_file = dirname(__FILE__).'/ga_code') ? file_get_contents($ga_code_file) : null);
	require_once dirname(__FILE__).'/src/SiteInfo.php';
	require_once dirname(__FILE__).'/src/SiteModule.php';
	require_once dirname(__FILE__).'/functions.inc.php';
	require_once dirname(__FILE__).'/src/FontCharMap.php';
	require_once dirname(__FILE__).'/src/store/PaymentGateway.php';
	require_once dirname(__FILE__).'/src/store/StoreRegion.php';
	require_once dirname(__FILE__).'/src/store/StoreCountry.php';
	require_once dirname(__FILE__).'/src/store/StoreNavigation.php';
	require_once dirname(__FILE__).'/src/store/StoreData.php';
	require_once dirname(__FILE__).'/src/store/StoreModuleBuyer.php';
	require_once dirname(__FILE__).'/src/store/StoreModuleOrder.php';
	require_once dirname(__FILE__).'/src/store/StoreModuleOrderItemCustomField.php';
	require_once dirname(__FILE__).'/src/store/StoreModuleOrderItem.php';
	require_once dirname(__FILE__).'/src/store/StoreCurrency.php';
	require_once dirname(__FILE__).'/src/store/StorePriceOptions.php';
	require_once dirname(__FILE__).'/src/store/StoreModule.php';
	require_once dirname(__FILE__).'/src/store/StoreBillingInfo.php';
	require_once dirname(__FILE__).'/src/store/StoreCartData.php';
	require_once dirname(__FILE__).'/src/store/StoreCartApi.php';
	require_once dirname(__FILE__).'/src/store/StorePaymentApi.php';
	require_once dirname(__FILE__).'/src/store/StoreBaseElement.php';
	require_once dirname(__FILE__).'/src/store/StoreElement.php';
	require_once dirname(__FILE__).'/src/store/StoreCartElement.php';
	require_once dirname(__FILE__).'/tcpdf/tcpdf_autoconfig.php';
	require_once dirname(__FILE__).'/tcpdf/tcpdf.php';
	require_once dirname(__FILE__).'/src/store/StoreInvoice.php';
	require_once dirname(__FILE__).'/src/store/StoreInvoiceApi.php';
	$siteInfo = SiteInfo::build(array('siteId' => $site_id, 'websiteUID' => $websiteUID, 'domain' => $user_domain, 'homePageId' => $home_page, 'baseDir' => $base_dir, 'baseUrl' => $base_url, 'defLang' => $def_lang, 'baseLang' => $base_lang, 'userKey' => $user_key, 'userHash' => $user_hash, 'commentsCallback' => $comment_callback, 'langs' => $langs, 'pages' => $pages, 'forms' => $forms, 'modRewrite' => $mod_rewrite, 'gaCode' => $ga_code, 'gaAnonymizeIp' => false, 'port' => null, 'pathPrefix' => null, 'useTrailingSlashes' => true,));
	$requestInfo = SiteRequestInfo::build(array('requestUri' => getRequestUri($siteInfo->baseUrl),));
	SiteModule::init(null, $siteInfo);
	StoreModule::init((object) array(
		'storeElementsLangsAndPages' => array(
			'en' => array(
				0 => 5
			)
		),
		'defaultStorePageId' => array(
			'' => 5,
			'en' => 5
		),
		'hasTableView' => false,
		'hasPrices' => false,
		'gatewayConfig' => array(),
		'contactFormId' => '03ebd2e9'
	), $siteInfo);
	list($page_id, $lang, $urlArgs, $route) = parse_uri($siteInfo, $requestInfo);
	$preview = false;
	$requestInfo->{'page'} = (isset($pages[$page_id]) ? $pages[$page_id] : null);
	$requestInfo->{'lang'} = $lang;
	$requestInfo->{'urlArgs'} = $urlArgs;
	$requestInfo->{'route'} = $route;
	handleTrailingSlashRedirect($siteInfo, $requestInfo);
	SiteModule::setLang($requestInfo->{'lang'});
	SiteModule::initTranslations(array(
		'-' => array(
			'Form sending failed' => 'Form sending failed',
			'Form was not sent, are you a robot?' => 'Form was not sent, are you a robot?',
			'File %s is too big' => 'File %s is too big',
			'File %s could not be uploaded for sending' => 'File %s could not be uploaded for sending',
			'Total size of attachments must not exceed %s MB' => 'Total size of attachments must not exceed %s MB',
			'Field %s is not present' => 'Field %s is not present',
			'Failed to create a directory for attachments' => 'Failed to create a directory for attachments',
			'Attachments inode on the server is not a directory' => 'Attachments inode on the server is not a directory',
			'Failed to move uploaded file to attachments directory' => 'Failed to move uploaded file to attachments directory',
			'Receiver not specified' => 'Receiver not specified',
			'Order ID' => 'Order ID',
			'Invoice document number' => 'Invoice document number',
			'Payment gateway' => 'Payment gateway',
			'Payer (from gateway)' => 'Payer (from gateway)',
			'Billing Information' => 'Billing Information',
			'Delivery Information' => 'Delivery Information',
			'Same as billing information' => 'Same as billing information',
			'Email' => 'E-mail',
			'Phone Number' => 'Phone Number',
			'Private person' => 'Private person',
			'Company' => 'Company',
			'Company Name' => 'Company Name',
			'Company Code' => 'Company Code',
			'Company TAX/VAT number' => 'Company TAX/VAT number',
			'First Name' => 'First Name',
			'Last Name' => 'Last Name',
			'Address' => 'Address',
			'City' => 'City',
			'Post Code' => 'Post Code',
			'Region' => 'Region',
			'Country Code' => 'Country Code',
			'Country' => 'Country',
			'days' => 'days',
			'Qty' => 'Qty',
			'Price' => 'Price',
			'Date' => 'Date',
			'The cart is empty' => 'The cart is empty',
			'SKU' => 'SKU',
			'Product description' => 'Product description',
			'Buyer' => 'Buyer',
			'Seller' => 'Seller',
			'Invoice' => 'Invoice',
			'Remove' => 'Remove',
			'Total' => 'Total',
			'Subtotal' => 'Subtotal',
			'Totals' => 'Totals',
			'Back' => 'Back',
			'Previous' => 'Previous',
			'Next' => 'Next',
			'Next Step' => 'Next Step',
			'Checkout' => 'Checkout',
			'Shipping Method' => 'Shipping Method',
			'Order Comments' => 'Order Comments',
			'Close' => 'Close',
			'Zoom in/out' => 'Zoom in/out',
			'Add to cart' => 'Add to cart',
			'Inquire' => 'Enquire',
			'Category' => 'Category',
			'Item Name' => 'Item Name',
			'Text search' => 'Text search',
			'From' => 'From',
			'To' => 'To',
			'Created' => 'Created',
			'Modified' => 'Modified',
			'Description' => 'Description',
			'Search' => 'Search',
			'Sort' => 'Sort',
			'Tax' => 'Tax',
			'Shipping' => 'Shipping',
			'Choose Payment Method' => 'Choose Payment Method',
			'Order with obligation to pay' => 'Order with obligation to pay',
			'Thank you for your purchase.' => 'Thank you for your purchase.',
			'You can download invoice in PDF format by following this link' => 'You can download invoice in PDF format by following this link',
			'You must agree to terms and conditions' => 'You must agree to terms and conditions',
			'Order Details' => 'Order Details',
			'All' => 'All',
			'Total price of items in the cart should be %s or more' => 'Total price of items in the cart should be %s or more',
			'Buy Now' => 'Buy Now',
			'Paid' => 'Paid',
			'Pending' => 'Pending',
			'Added!' => 'Added!',
			'Payment received for order %s at %s' => 'Payment received for order %s at %s',
			'New order %s at %s' => 'New order %s at %s',
			'Order_payment' => 'Order',
			'An error occurred. Please try again.' => 'An error occurred. Please try again.',
			'No items found' => 'No items found',
			'Payment has been submitted' => 'Payment has been submitted',
			'Payment has been canceled' => 'Payment has been cancelled'
		)
	));
	if (!isHttps() && !headers_sent()) {
		header('Status: 301 Moved Permanently');
		header('Location: '.getCurrUrl(false, 'https'));
		exit();
	}
	$hr_out = '';
	if (is_callable('StoreModule::parseRequest')) $hr_out .= call_user_func('StoreModule::parseRequest', $requestInfo);
	$page = $requestInfo->{'page'};
	if (!is_null($page)) {
		handleComments($page['id'], $siteInfo);
		if (isset($_POST["wb_form_id"])) handleForms($page['id'], $siteInfo);
	}
	ob_start();
	if ($page) {
		$fl = dirname(__FILE__).'/'.$page['file'];
		if (is_file($fl)) {
			${'seoTitle'} = $requestInfo->{'title'};
			${'seoDescription'} = $requestInfo->{'description'};
			${'seoKeywords'} = $requestInfo->{'keywords'};
			${'seoImage'} = $requestInfo->{'image'};
			if (isset($_GET['wbPopupMode']) && $_GET['wbPopupMode'] == 1) { $wbPopupMode = true; }
			if (isset($_GET['wbLandingPage']) && $_GET['wbLandingPage']) { $wbLandingPage = $_GET['wbLandingPage']; }
			ob_start();
			include $fl;
			$out = ob_get_clean();
			$ga_out = '';
			if ($lang && $langs) {
				foreach ($langs as $ln => $default) {
					$pageUri = getPageUri($page['id'], $ln, $siteInfo);
					$out = str_replace(urlencode('{{lang_'.$ln.'}}'), $pageUri, $out);
				}
			}
			if (is_file($ga_tpl = dirname(__FILE__).'/ga.php')) {
				ob_start(); include $ga_tpl; $ga_out = ob_get_clean();
			}
			$out = str_replace('<ga-code/>', $ga_out, $out);
			$out = str_replace('{{base_url}}', getBaseUrl(), $out);
			$out = str_replace('{{curr_url}}', getCurrUrl(), $out);
			$out = str_replace('{{hr_out}}', $hr_out, $out);
			header('Content-type: text/html; charset=utf-8', true);
			echo $out;
		}
	} else {
		header("Content-type: text/html; charset=utf-8", true, 404);
		if (is_file(dirname(__FILE__).'/../../error_docs/not_found.html')) {
			include dirname(__FILE__).'/../../error_docs/not_found.html';
		} else if (is_file(dirname(__FILE__).'/404.html')) {
			include dirname(__FILE__).'/404.html';
		} else {
			echo "<!DOCTYPE html>\n";
			echo "<html>\n";
			echo "<head>\n";
			echo "<title>404 Not found</title>\n";
			echo "</head>\n";
			echo "<body>\n";
			echo "404 Not found\n";
			echo "</body>\n";
			echo "</html>";
		}
	}
	ob_end_flush();

?>