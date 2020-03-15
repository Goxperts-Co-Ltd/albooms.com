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
                <?php foreach( $rel_products  as $key => $related) :?>
				<div class="product-item">
					<div class="pi-pic">
						<img src="<?php echo wp_get_attachment_url($related->image_id); ?>" alt="">
						<div class="pi-links">
							<a href="<?php the_permalink($related->id);?>" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
							<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
						</div>
					</div>
					<div class="pi-text">
						<h6><?php echo $related->price; ?></h6>
						<p><?php echo $related->name; ?></p>
					</div>
                </div>
                <?php endforeach;?>
			</div>
		</div>
	</section>