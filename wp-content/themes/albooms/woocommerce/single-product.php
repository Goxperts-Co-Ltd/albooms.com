<?php
get_header();
?>
<?php
    	
global $post;
global $product;
$terms = get_the_terms( $post->ID, 'product_cat');
$attributes = $product->get_attributes();
$available_variations = $product->get_available_variations();

?>

	<!-- Page info -->
	<div class="page-top-info">
		<div class="container">
			<h4>Category PAge</h4>
			<div class="site-pagination">
				<a href="">Home</a> 
				<a href="">Shop</a>
			</div>
		</div>
	</div>
	<!-- Page info end -->


	<!-- product section -->
	<section class="product-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="product-pic-zoom">
						<img class="product-big-img" src="<?php echo wp_get_attachment_image_src( $product->get_image_id(),'full')[0]; ?>" alt="">
					</div>
					<div class="product-thumbs" tabindex="1" style="overflow: hidden; outline: none;">
						<div class="product-thumbs-track">
							<!-- Featured Image as default -->
						<div class="pt active" data-imgbigurl="<?php echo wp_get_attachment_image_src( $product->get_image_id(),'full')[0]; ?>"><img src="<?php echo wp_get_attachment_image_src( $product->get_image_id(),'full')[0]; ?>" alt=""></div>
							<!-- Image Galleries -->
						<?php  foreach($product->get_gallery_image_ids() as $gallery) : ?>				
							<div class="pt" data-imgbigurl="<?php echo wp_get_attachment_image_src( $gallery,'full')[0]; ?>"><img src="<?php echo wp_get_attachment_image_src( $gallery,'full')[0]; ?>" alt=""></div>
						<?php endforeach; ?>
						</div>
					</div>
				</div>
				<div class="col-lg-6 product-details">
					<h2 class="p-title"><?php echo $product->get_name(); ?></h2>
					<h3 class="p-price"><?php echo $product->get_price_html(); ?></h3>
					<!-- <h4 class="p-stock">Available: <span>In Stock</span></h4> -->
					<div class="p-rating">
						<i class="fa fa-star-o"></i>
						<i class="fa fa-star-o"></i>
						<i class="fa fa-star-o"></i>
						<i class="fa fa-star-o"></i>
						<i class="fa fa-star-o fa-fade"></i>
					</div>
					<div class="p-review">
						<a href=""><?php echo $product->get_review_count();?> reviews</a>|<a href="">Add your review</a>
					</div>
					<div id="accordion" class="accordion-area">
						<div class="panel">
							<div class="panel-header" id="headingOne">
								<button class="panel-link active" data-toggle="collapse" data-target="#collapse12" aria-expanded="true" aria-controls="collapse1">Sizes</button>
							</div>
							<div id="collapse12" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="panel-body">
								<div class="col-md-5">		
							      <?php foreach($available_variations as $key => $sizes) : //print_r(); ?>
									 <div class="cfr-item">
										<input type="radio" name="pm" id="<?php echo $option; ?>">
										<label for="<?php echo $sizes['attributes']['attribute_sizes']; ?>"><?php echo $sizes['attributes']['attribute_sizes']; ?></label>
									 </div>
								    <?php endforeach; ?>
						      </div>
							</div>
						  </div>
						 </div>
					<!-- <div class="quantity">
						<p>Quantity</p>
                        <div class="pro-qty"><input type="text" value="1"></div>
                    </div> -->
						<div class="panel">
							<div class="panel-header" id="headingOne">
								<button class="panel-link active" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">information</button>
							</div>
							<div id="collapse1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="panel-body">
									<?php echo $product->get_description(); ?>
								</div>
							</div>
						</div>
						<div class="panel">
							<div class="panel-header" id="headingTwo">
								<button class="panel-link" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">care details </button>
							</div>
							<div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
								<div class="panel-body">
									<img src="<?php bloginfo('stylesheet_directory');?>/assets/img/cards.png" alt="">
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so dales. Phasellus sagittis auctor gravida. Integer bibendum sodales arcu id te mpus. Ut consectetur lacus leo, non scelerisque nulla euismod nec.</p>
								</div>
							</div>
						</div>
						<div class="panel">
							<div class="panel-header" id="headingThree">
								<button class="panel-link" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">shipping & Returns</button>
							</div>
							<div id="collapse3" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
								<div class="panel-body">
									<h4>7 Days Returns</h4>
									<p>Cash on Delivery Available<br>Home Delivery <span>3 - 4 days</span></p>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so dales. Phasellus sagittis auctor gravida. Integer bibendum sodales arcu id te mpus. Ut consectetur lacus leo, non scelerisque nulla euismod nec.</p>
								</div>
							</div>
						</div>
					</div>
					<div class="buton">
						<a href="#" class="site-btn">SHOP NOW</a>
					</div>			
					<div class="social-sharing">
						<a href=""><i class="fa fa-google-plus"></i></a>
						<a href=""><i class="fa fa-pinterest"></i></a>
						<a href=""><i class="fa fa-facebook"></i></a>
						<a href=""><i class="fa fa-twitter"></i></a>
						<a href=""><i class="fa fa-youtube"></i></a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- product section end -->


	<!-- RELATED PRODUCTS section -->
	<?php get_template_part( 'template-parts/related-products'); ?>
	<!-- RELATED PRODUCTS section end -->

<?php
get_footer();