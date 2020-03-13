<?php
//get shop products
$query = new WC_Product_Query(array(
    'post_type' => 'product',						
    'limit' => 8,
    'order' => 'DESC'
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
        
                    ?>
						<div class="col-lg-4 col-sm-6">
							<div class="product-item">
								<div class="pi-pic">
									<!-- <div class="tag-sale">ON SALE</div> -->
									<img src="<?php echo wp_get_attachment_url($p_image); ?>" alt="<?php echo  $p_name;?>" title="<?php echo  $p_name;?>">
									<div class="pi-links">
										<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
										<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
									</div>
								</div>
								<div class="pi-text">
									<h6><?php echo $p_price;?></h6>
									<p><a href="<?php echo get_permalink($p_id);?>"><?php echo  $p_name;?></a></p>
								</div>
							</div>
						</div>
					<?php } } ?> 
						<div class="text-center w-100 pt-3">
							<button class="site-btn sb-line sb-dark">LOAD MORE</button>
						</div>
					</div>
				</div>