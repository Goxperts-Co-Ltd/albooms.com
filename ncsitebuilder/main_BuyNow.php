<?php
require_once dirname(__FILE__).'/GatewayPaypal.php';
$localeIdx = array_search($pluginData->currLangLocale, GatewayPaypal::$supportedLocales);
$useLocale = $localeIdx ? GatewayPaypal::$supportedLocales[$localeIdx] : 'en_US';
?>
<input type="hidden" name="item_name" value="<?php echo tr_($pluginData->itemName); ?>" />
<input type="hidden" name="lc" value="<?php echo $useLocale; ?>" />
<?php echo $pluginData->paymentGatewayButton; ?>
