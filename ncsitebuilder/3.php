<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php echo htmlspecialchars(($seoTitle !== "") ? $seoTitle : "Album Factory"); ?></title>
	<base href="{{base_url}}" />
			<meta name="viewport" content="width=1200" />
		<meta name="description" content="<?php echo htmlspecialchars(($seoDescription !== "") ? $seoDescription : ""); ?>" />
	<meta name="keywords" content="<?php echo htmlspecialchars(($seoKeywords !== "") ? $seoKeywords : ""); ?>" />
		<!-- Facebook Open Graph -->
	<meta property="og:title" content="<?php echo htmlspecialchars(($seoTitle !== "") ? $seoTitle : "Album Factory"); ?>" />
	<meta property="og:description" content="<?php echo htmlspecialchars(($seoDescription !== "") ? $seoDescription : ""); ?>" />
	<meta property="og:image" content="<?php echo htmlspecialchars(($seoImage !== "") ? "{{base_url}}".$seoImage : ""); ?>" />
	<meta property="og:type" content="article" />
	<meta property="og:url" content="{{curr_url}}" />
	<!-- Facebook Open Graph end -->
		
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>
	<script src="js/main.js?v=20200229031320" type="text/javascript"></script>

	<link href="css/font-awesome/font-awesome.min.css?v=4.7.0" rel="stylesheet" type="text/css" />
	<link href="css/site.css?v=20200229031320" rel="stylesheet" type="text/css" id="wb-site-stylesheet" />
	<link href="css/common.css?ts=1583149391" rel="stylesheet" type="text/css" />
	<link href="css/3.css?ts=1583149391" rel="stylesheet" type="text/css" id="wb-page-stylesheet" />
	<ga-code/><link rel="icon" href="/gallery/aflogo-ts1582527878.jpg" type="image/jpeg" /><meta name="google-site-verification" content="" />
	<script type="text/javascript">
	window.useTrailingSlashes = true;
</script>
	
	<link href="css/flag-icon-css/css/flag-icon.min.css" rel="stylesheet" type="text/css" />	
	<!--[if lt IE 9]>
	<script src="js/html5shiv.min.js"></script>
	<![endif]-->

	</head>


<body class="site <?php if (isset($wbPopupMode) && $wbPopupMode) echo ' popup-mode'; ?>" <?php if (isset($wbLandingPage) && $wbLandingPage) echo ' data-landing-page="'.$wbLandingPage.'"'; ?>><div class="root"><div class="vbox wb_container" id="wb_header">
	
<div class="wb_cont_inner"><div id="wb_element_instance74" class="wb_element wb-menu"><ul class="hmenu"><li><a href="" target="_self">Home</a></li><li><a href="About-Us/" target="_self">About Us</a></li><li><a href="Work-Process/" target="_self">Work Process</a></li><li><a href="Shopping-Cart/" target="_self">Shopping Cart</a></li><li class="active"><a href="Contacts/" target="_self">Contacts</a></li></ul><div class="clearfix"></div></div><div id="wb_element_instance75" class="wb_element wb_element_picture" title=""><img alt="gallery/untitled-1" src="gallery_gen/85cdc4e187182d7bc160312dd5a02418_270x95.png"></div></div><div class="wb_cont_outer"><div id="wb_element_instance76" class="wb_element wb_element_shape"><a class="wb_shp"></a></div></div><div class="wb_cont_bg"></div></div>
<div class="vbox wb_container" id="wb_main">
	
<div class="wb_cont_inner"><div id="wb_element_instance78" class="wb_element wb_text_element" style=" line-height: normal;"><h1 class="wb-stl-heading1" style="text-align:center"><span class="wb-stl-highlight">Contacts</span></h1></div><div id="wb_element_instance79" class="wb_element"><form class="wb_form" method="post" enctype="multipart/form-data"><input type="hidden" name="wb_form_id" value="c0be462c"><textarea name="message" rows="3" cols="20" class="hpc" autocomplete="off"></textarea><table><tr><th class="wb-stl-normal">Name&nbsp;&nbsp;</th><td><input type="hidden" name="wb_input_0" value="Name"><input class="form-control form-field" type="text" value="" name="wb_input_0" required="required"></td></tr><tr><th class="wb-stl-normal">E-mail&nbsp;&nbsp;</th><td><input type="hidden" name="wb_input_1" value="E-mail"><input class="form-control form-field" type="text" value="" name="wb_input_1" required="required"></td></tr><tr><th class="wb-stl-normal">Country&nbsp;&nbsp;</th><td><input type="hidden" name="wb_input_2" value="Country"><input class="form-control form-field" type="text" value="" name="wb_input_2" required="required"></td></tr><tr><th class="wb-stl-normal">City&nbsp;&nbsp;</th><td><input type="hidden" name="wb_input_3" value="City"><input class="form-control form-field" type="text" value="" name="wb_input_3" required="required"></td></tr><tr><th class="wb-stl-normal">Address&nbsp;&nbsp;</th><td><input type="hidden" name="wb_input_4" value="Address"><input class="form-control form-field" type="text" value="" name="wb_input_4" required="required"></td></tr><tr class="area-row"><th class="wb-stl-normal">Message&nbsp;&nbsp;</th><td><input type="hidden" name="wb_input_5" value="Message"><textarea class="form-control form-field form-area-field" rows="3" cols="20" name="wb_input_5" required="required"></textarea></td></tr><tr class="form-footer"><td colspan="2"><button type="submit" class="btn btn-default">Submit</button></td></tr></table><?php if (isset($wbPopupMode) && $wbPopupMode): ?><input type="hidden" name="wb_popup_mode" value="1" /><?php endif; ?></form><script type="text/javascript">
			<?php $wb_form_id = popSessionOrGlobalVar("wb_form_id"); if ($wb_form_id == "c0be462c") { ?>
				<?php $wb_form_send_success = popSessionOrGlobalVar("wb_form_send_success"); ?>
				var formValues = <?php echo json_encode(popSessionOrGlobalVar("post")); ?>;
				var formErrors = <?php echo json_encode(popSessionOrGlobalVar("formErrors")); ?>;
				wb_form_validateForm("c0be462c", formValues, formErrors);
				<?php if (($wb_form_send_state = popSessionOrGlobalVar("wb_form_send_state"))) { ?>
					<?php if (($wb_form_popup_mode = popSessionOrGlobalVar("wb_form_popup_mode"))) { ?>
					if (window !== window.parent && window.parent.postMessage) {
						var data = {
							event: "wb_contact_form_sent",
							data: {
								state: "<?php echo str_replace('"', '\"', $wb_form_send_state); ?>",
								type: "<?php echo $wb_form_send_success ? "success" : "danger"; ?>"
							}
						};
						window.parent.postMessage(data, "<?php echo str_replace('"', '\"', popSessionOrGlobalVar("wb_target_origin")); ?>");
					}
					<?php } else { ?>
					wb_show_alert("<?php echo str_replace(array('"', "\n"), array('\"', "\\"), $wb_form_send_state); ?>", "<?php echo $wb_form_send_success ? "success" : "danger"; ?>");
					<?php } ?>
					<?php $wb_form_send_success = false; $wb_form_send_state = null; $wb_form_popup_mode = false; ?>
				<?php } ?>
			<?php } ?>
			</script></div><div id="wb_element_instance80" class="wb_element wb_text_element" style=" line-height: normal;"><p class="wb-stl-normal">Phone: <br>
USA +1 760 284 3344</p>

<p class="wb-stl-normal">E-mail: <br>
team@albooms.com</p>
</div></div><div class="wb_cont_outer"></div><div class="wb_cont_bg"></div></div>
<div class="vbox wb_container" id="wb_footer">
	
<div class="wb_cont_inner" style="height: 200px;"><div id="wb_element_instance81" class="wb_element wb_element_picture" title=""><i class="fa fa-facebook-square" style="color:#ffffff"></i></div><div id="wb_element_instance82" class="wb_element wb_text_element" style=" line-height: normal;"><p class="wb-stl-normal"><span style="color:rgba(255,255,255,1);">© 2020 GoXperts. All rights reserved.</span></p>
</div><div id="wb_element_instance83" class="wb_element wb_text_element" style=" line-height: normal;"><p class="wb-stl-normal"><strong><font color="#ffffff">Address:</font></strong><br><span style="color:rgba(255,255,255,1);">CJA Building B5-G L2 Bach St. Jade Ave. Jade Heights Tunasan, Muntinlupa 1773</span></p>
</div><div id="wb_element_instance84" class="wb_element wb_text_element" style=" line-height: normal;"><p class="wb-stl-normal"><span style="color:rgba(250,250,250,1);"><strong>Phone: </strong><br>
USA +1 760 284 3344</span></p>

<p class="wb-stl-normal"><span style="color:rgba(250,250,250,1);"><strong>E-mail: </strong><br>
team@albooms.com</span></p>
</div><div id="wb_element_instance86" class="wb_element" style="text-align: center; width: 100%;"><div class="wb_footer"></div><script type="text/javascript">
			$(function() {
				var footer = $(".wb_footer");
				var html = (footer.html() + "").replace(/^\s+|\s+$/g, "");
				if (!html) {
					footer.parent().remove();
					footer = $("#wb_footer, #wb_footer .wb_cont_inner");
					footer.css({height: ""});
				}
			});
			</script></div></div><div class="wb_cont_outer"><div id="wb_element_instance77" class="wb_element wb_element_shape"><a class="wb_shp"></a></div><div id="wb_element_instance85" class="wb_element wb_element_shape"><a class="wb_shp"></a></div></div><div class="wb_cont_bg"></div></div><div class="wb_sbg"></div></div>{{hr_out}}</body>
</html>
