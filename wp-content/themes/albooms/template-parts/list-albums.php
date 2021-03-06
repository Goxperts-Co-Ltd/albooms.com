<?php
$list_albums = new WC_Product_Query(array(
    'post_type' => 'product',						
    'order' => 'ASC',
    'post_status' => 1,
    'limit' => 8
    ));
    $product_list = $list_albums->get_products();

?>

<section class="product-filter-section">
		<div class="container">
			<div class="section-title">
				<h2>BROWSE TOP SELLING ALBUMS</h2>
			</div>
			<div class="row">
            <?php if (!empty($product_list))  : ?>
                    <?php foreach ($product_list as $product) :              
                             $p_id = $product->id;
                             $p_name = $product->name;
                             $p_price = $product->price;
							 $p_image = $product->image_id; 
							 $newness_days = 3;
							 $created = strtotime( $product->get_date_created() );   
                    ?>
				<div class="col-lg-3 col-sm-6">
					<div class="product-item">
						<div class="pi-pic">
						<?php 
							if ( ( time() - ( 60 * 60 * 24 * $newness_days ) ) < $created ) {
								echo '<div class="tag-new">New</div>';
							}
						?>
							<a href="<?php echo get_permalink($p_id);?>"><img src="<?php echo wp_get_attachment_url($p_image); ?>" alt="<?php echo  $p_name;?>" title="<?php echo  $p_name;?>"></a>
							<div class="pi-links">
							<?php
								echo apply_filters(
									'woocommerce_loop_add_to_cart_link',
									sprintf(
											'<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>',
											esc_url( $product->add_to_cart_url() ),
											esc_attr( $product->get_id() ),
											esc_attr( $product->get_sku() ),
											$product->is_purchasable() ? 'add_to_cart_button' : '',
											esc_attr( $product->product_type ),
											esc_html( $product->add_to_cart_text() )
											),
											$product);
						    ?>
								<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
							</div>
						</div>
						<div class="pi-text">
						    <p><?php echo $product->get_price_html(); ?></p>
							<h5><a href="<?php echo get_permalink($p_id);?>"><?php echo  $p_name;?></a></h5>
						</div>
					</div>
				</div>
                <?php endforeach;?>
                <?php else : ?>
                    <div class="pi-text">
							<p>No Products Available!</p>
						</div>
                <?php endif;wp_reset_query(); ?> 
			</div>
           