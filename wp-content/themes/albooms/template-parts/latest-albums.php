<?php
$query = new WC_Product_Query(array(
    'post_type' => 'product',						
    'order' => 'ASC',
    'post_status' => 1,
    'post_per_page' => 4,
    'hide_empty' => 1
    ));
    $products = $query->get_products();

?>
<section class="top-letest-product-section">
		<div class="container">
			<div class="section-title">
				<h2>LATEST ALBUMS</h2>
			</div>
			<div class="product-slider owl-carousel">
                <?php if (!empty($products))  : ?>
                    <?php foreach ($products as $product) :              
                             $p_id = $product->id;
                             $p_name = $product->name;
                             $p_price = $product->price;
                             $p_image = $product->image_id;    
                    ?>
				<div class="product-item">
					<div class="pi-pic">
                    <div class="tag-new">New</div>
						<img src="<?php echo wp_get_attachment_url($p_image); ?>" alt="">
						<div class="pi-links">
							<a href="<?php echo get_permalink($p_id);?>" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
							<a href="#" class="wishlist-btn"><i class="flaticon-heart"></i></a>
						</div>
					</div>
					<div class="pi-text">
						<h6><?php echo $p_price;?></h6>
						<p><?php echo  $p_name;?></p>
					</div>
				</div>
                <?php endforeach;?>
                <?php else : ?>
                    <div class="pi-text">
							<p>No Albums Available!</p>
						</div>
                <?php endif;wp_reset_postdata(); ?>  
			</div>
		</div>
	</section>