<!DOCTYPE html>
<head>
<html <?php language_attributes(); ?> style="margin-top:0 !important;">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- header start -->
<?php wp_head(); ?>
<!-- end of Header -->


	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-4KT6DY51LL"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-4KT6DY51LL');
</script>
<!-- Adsense -->
<script data-ad-client="ca-pub-4712491227153267" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- end of adsense -->
	</head>
<body>
	<!-- Page Preloder -->
	<!-- <div id="preloder">
		<div class="loader"></div>
	</div> -->

	<!-- Header section -->
	<header class="header-section">
		<div class="header-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 text-center text-lg-left">
						<!-- logo -->
						<a href="./index.html" class="site-logo">
							<img src="img/logo.png" alt="">
						</a>
					</div>
					<div class="col-xl-6 col-lg-5">
						<form class="header-search-form">
							<input type="text" placeholder="Search on divisima ....">
							<button><i class="flaticon-search"></i></button>
						</form>
					</div>
					<div class="col-xl-4 col-lg-5">
						<div class="user-panel">
							<div class="up-item">
								<i class="flaticon-profile"></i>
								<a href="#">Sign</a> In or <a href="#">Create Account</a>
							</div>
							<div class="up-item">
								<div class="shopping-card">
									<i class="flaticon-bag"></i>
									<span>0</span>
								</div>
								<a href="#">Shopping Cart</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<nav class="main-navbar">
			<div class="container">
				<!-- menu -->
				<ul class="main-menu">
<!-- 					
					<li><a href="#">Men</a></li>
					<li><a href="#">Jewelry
						<span class="new">New</span>
					</a></li>
					<li><a href="#">Shoes</a>
						<ul class="sub-menu">
							<li><a href="#">Sneakers</a></li>
							<li><a href="#">Sandals</a></li>
							<li><a href="#">Formal Shoes</a></li>
							<li><a href="#">Boots</a></li>
							<li><a href="#">Flip Flops</a></li>
						</ul>
					</li>
					<li><a href="#">Pages</a>
						<ul class="sub-menu">
							<li><a href="./product.html">Product Page</a></li>
							<li><a href="./category.html">Category Page</a></li>
							<li><a href="./cart.html">Cart Page</a></li>
							<li><a href="./checkout.html">Checkout Page</a></li>
							<li><a href="./contact.html">Contact Page</a></li>
						</ul>
					</li>
					<li><a href="#">Blog</a></li> -->
					<?php if (!is_woocommerce() && !is_cart() && !is_checkout()) { ?>
						<?php  echo wp_get_main_menu_array('main menu');?>
					<?php }else{ ?>
						<?php  echo wp_get_shop_menu_array('shop menu');?>
					<?php } ?>
				</ul>
				
			</div>
		</nav>
	</header>
	<!-- Header section end -->


