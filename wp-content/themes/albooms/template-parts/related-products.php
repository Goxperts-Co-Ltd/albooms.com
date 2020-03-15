<?php	
global $post;
$terms = get_the_terms( $post->ID, 'product_cat' );
foreach ( $terms as $term ) {
    $product_cat_id = $term->term_id;  
    //do nothing here
    break;
}
$product_cat_slug = $term->slug;
//get the product category url  
    $rel_query = new WC_Product_Query(array(
        'post_type' => 'product',
        'product_cat'   => $product_cat_slug,					
        'order' => 'ASC'
                ));
    $rel_products = $rel_query->get_products(); 
    ?>
<section class="related-product-section">
		<div class="container">
			<div class="section-title">
				<h2>RELATED PRODUCTS</h2>
			</div>
			<div class="product-slider owl-carousel">
				<?php foreach( $rel_products  as $key => $related) :
					$newness_days = 3;
					$created = strtotime( $related->get_date_created() );
					?>
				<div class="product-item">
					<div class="pi-pic">
					<?php 
						if ( ( time() - ( 60 * 60 * 24 * $newness_days ) ) < $created ) {
							echo '<div class="tag-new">New</div>';
						}
					?>
						<a href="<?php the_permalink($related->id);?>"><img src="<?php echo wp_get_attachment_url($related->image_id); ?>" alt="<?php echo $related->name; ?>" title="<?php echo $related->name; ?>"></a>
						<div class="pi-links">
						<?php
						 echo apply_filters(
							'woocommerce_loop_add_to_cart_link',
							sprintf(
								    '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>',
									esc_url( $related->add_to_cart_url() ),
									esc_attr( $related->get_id() ),
									esc_attr( $related->get_sku() ),
									$related->is_purchasable() ? 'add_to_cart_button' : '',
									esc_attr( $related->product_type ),
									esc_html( $related->add_to_cart_text() )
									),
									$related);
						?>
							<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
						</div>
					</div>
					<div class="pi-text">
					    <p><?php echo $related->get_price_html(); ?></p>
						<h5><a href="<?php the_permalink($related->id);?>"><?php echo $related->name; ?></a></h5>
					</div>
                </div>
                <?php endforeach; wp_reset_query(); ?>
			</div>
		</div>
	</section>