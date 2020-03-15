<?php
//get shop products
$term = get_queried_object();
$cat_slug =  $term->slug;
$query = new WC_Product_Query(array(
	'post_type' => 'product',
	'product_cat'   =>  $cat_slug,						
    'limit' => 8,
	'order' => 'ASC',
	'post_status' => 1,
    ));
    $products = $query->get_products();

?>
<div class="col-lg-9  order-1 order-lg-2 mb-5 mb-lg-0">
					<div class="row">
                  <?php   if (!empty($products)) {
                        foreach ($products as $product) {
                             $p_id = $product->id;
                             $p_name = $product->name;
                             $p_price = $product->price;
							 $p_image = $product->image_id;
							 $newness_days = 3;
							 $created = strtotime( $product->get_date_created() );
        
                    ?>
						<div class="col-lg-4 col-sm-6">
							<div class="product-item">
								<div class="pi-pic">
									<!-- <div class="tag-sale">ON SALE</div> -->
									<?php 
									if ( ( time() - ( 60 * 60 * 24 * $newness_days ) ) < $created ) {
										echo '<div class="tag-new">New</div>';
									}
									?>
									<a href="<?php echo get_permalink($p_id);?>"><img src="<?php echo wp_get_attachment_url($p_image); ?>" alt="<?php echo  $p_name;?>" title="<?php echo  $p_name;?>"></a>
									<div class="pi-links">
										<a href="<?php echo get_permalink($p_id);?>" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
										<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
									</div>
								</div>
								<div class="pi-text">
								    <p><?php echo $product->get_price_html(); ?></p>
									<p><a href="<?php echo get_permalink($p_id);?>"><?php echo  $p_name;?></a></p>
								</div>
							</div>
						</div>
					<?php } }else{
						echo '<p>No Albums Available!</p>';
					} ?> 
						<!-- <div class="text-center w-100 pt-3">
							<button class="site-btn sb-line sb-dark">LOAD MORE</button>
						</div> -->
					</div>
				</div>