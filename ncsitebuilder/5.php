<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php echo htmlspecialchars(($seoTitle !== "") ? $seoTitle : "Shopping Cart"); ?></title>
	<base href="{{base_url}}" />
			<meta name="viewport" content="width=1200" />
		<meta name="description" content="<?php echo htmlspecialchars(($seoDescription !== "") ? $seoDescription : ""); ?>" />
	<meta name="keywords" content="<?php echo htmlspecialchars(($seoKeywords !== "") ? $seoKeywords : ""); ?>" />
		<!-- Facebook Open Graph -->
	<meta property="og:title" content="<?php echo htmlspecialchars(($seoTitle !== "") ? $seoTitle : "Shopping Cart"); ?>" />
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
	<link href="css/5.css?ts=1583149391" rel="stylesheet" type="text/css" id="wb-page-stylesheet" />
	<link href="js/photoswipe/photoswipe.css" rel="stylesheet" type="text/css" />
	<link href="js/photoswipe/default-skin/default-skin.css" rel="stylesheet" type="text/css" />
	<script src="js/photoswipe/photoswipe.min.js" type="text/javascript"></script>
	<script src="js/photoswipe/photoswipe-ui-default.min.js" type="text/javascript"></script>
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
	
<div class="wb_cont_inner"><div id="wb_element_instance111" class="wb_element wb-menu"><ul class="hmenu"><li><a href="" target="_self">Home</a></li><li><a href="About-Us/" target="_self">About Us</a></li><li><a href="Work-Process/" target="_self">Work Process</a></li><li class="active"><a href="Shopping-Cart/" target="_self">Shopping Cart</a></li><li><a href="Contacts/" target="_self">Contacts</a></li></ul><div class="clearfix"></div></div><div id="wb_element_instance112" class="wb_element wb_element_picture" title=""><img alt="gallery/untitled-1" src="gallery_gen/85cdc4e187182d7bc160312dd5a02418_270x95.png"></div></div><div class="wb_cont_outer"><div id="wb_element_instance113" class="wb_element wb_element_shape"><a class="wb_shp"></a></div></div><div class="wb_cont_bg"></div></div>
<div class="vbox wb_container" id="wb_main">
	
<div class="wb_cont_inner"><div id="wb_element_instance116" class="wb_element wb_text_element" style=" line-height: normal;"><p style="text-align:center"><span class="wb-stl-highlight">ORDER NOW</span></p>
</div><div id="wb_element_instance117" class="wb_element"><script type="text/javascript" src="js/big.min.js"></script><script type="text/javascript" src="js/require.js"></script><script type="text/javascript" src="js/angular.min.js"></script><script type="text/javascript" src="js/bundle.js"></script><div class="wb-store"><a name="wbs1" class="wb_anchor"></a><?php StoreElement::render(StoreModule::$storeNav, (object) array(
	'id' => 'wb_element_instance117',
	'anchor' => 'wbs1',
	'hasPaymentGateways' => true,
	'hasForm' => true,
	'hasCart' => true,
	'thumbWidth' => 200,
	'thumbHeight' => 200,
	'imageWidth' => 300,
	'imageHeight' => 300,
	'filterPosition' => 'top',
	'showAddToCartInList' => true,
	'showBuyNowInList' => true,
	'showTextFilter' => true,
	'showPriceFilter' => true,
	'showSorting' => true,
	'showViewSwitch' => true,
	'imageBorderWidth' => 2,
	'imageBorderHeight' => 2,
	'itemsPerPage' => 0,
	'category' => 0
)); ?></div></div><div id="wb_element_instance118" class="wb_element wb-store-cart"><?php StoreCartElement::render(StoreModule::$storeNav, (object) array(
	'id' => 'wb_element_instance118',
	'name' => 'Shopping Cart',
	'icon' => 'gallery_gen/318fb2b405c621969122f503dae5348d.svg',
	'translations' => array()
)); ?></div></div><div class="wb_cont_outer"></div><div class="wb_cont_bg"></div></div>
<div class="vbox wb_container" id="wb_footer">
	
<div class="wb_cont_inner" style="height: 200px;"><div id="wb_element_instance114" class="wb_element wb_text_element" style=" line-height: normal;"><p class="wb-stl-normal"><strong><font color="#ffffff">Address:</font></strong><br><span style="color:rgba(255,255,255,1);">CJA Building B5-G L2 Bach St. Jade Ave. Jade Heights Tunasan, Muntinlupa 1773</span></p>
</div><div id="wb_element_instance119" class="wb_element wb_element_picture" title=""><i class="fa fa-facebook-square" style="color:#ffffff"></i></div><div id="wb_element_instance120" class="wb_element wb_text_element" style=" line-height: normal;"><p class="wb-stl-normal"><span style="color:rgba(255,255,255,1);">© 2020 GoXperts. All rights reserved.</span></p>
</div><div id="wb_element_instance121" class="wb_element wb_text_element" style=" line-height: normal;"><p class="wb-stl-normal"><span style="color:rgba(250,250,250,1);"><strong>Phone: </strong><br>
USA +1 760 284 3344</span></p>

<p class="wb-stl-normal"><span style="color:rgba(250,250,250,1);"><strong>E-mail: </strong><br>
team@albooms.com</span></p>
</div><div id="wb_element_instance125" class="wb_element" style="text-align: center; width: 100%;"><div class="wb_footer"></div><script type="text/javascript">
			$(function() {
				var footer = $(".wb_footer");
				var html = (footer.html() + "").replace(/^\s+|\s+$/g, "");
				if (!html) {
					footer.parent().remove();
					footer = $("#wb_footer, #wb_footer .wb_cont_inner");
					footer.css({height: ""});
				}
			});
			</script></div></div><div class="wb_cont_outer"><div id="wb_element_instance115" class="wb_element wb_element_shape"><a class="wb_shp"></a></div><div id="wb_element_instance122" class="wb_element wb_element_shape"><a class="wb_shp"></a></div></div><div class="wb_cont_bg"></div></div><div class="wb_sbg"></div></div>
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="pswp__bg" style="opacity: 0.7;"></div>
	<div class="pswp__scroll-wrap">
		<div class="pswp__container">
			<div class="pswp__item"></div>
			<div class="pswp__item"></div>
			<div class="pswp__item"></div>
		</div>
		<div class="pswp__ui pswp__ui--hidden">
			<div class="pswp__top-bar">
				<div class="pswp__counter"></div>
				<button class="pswp__button pswp__button--close" title="Close"></button>
				<button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
				<div class="pswp__preloader">
					<div class="pswp__preloader__icn">
						<div class="pswp__preloader__cut">
							<div class="pswp__preloader__donut"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
				<div class="pswp__share-tooltip"></div> 
			</div>
			<button class="pswp__button pswp__button--arrow--left" title="Previous"></button>
			<button class="pswp__button pswp__button--arrow--right" title="Next"></button>
			<div class="pswp__caption"><div class="pswp__caption__center"></div></div>
		</div>
	</div>
</div>
{{hr_out}}</body>
</html>
