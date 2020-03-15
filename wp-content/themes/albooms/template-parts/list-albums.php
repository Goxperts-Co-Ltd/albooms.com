<?php
$list_albums = new WC_Product_Query(array(
    'post_type' => 'product',						
    'order' => 'ASC',
    'post_status' => 1,
    'post_per_page' => 4,
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
                    ?>
				<div class="col-lg-3 col-sm-6">
					<div class="product-item">
						<div class="pi-pic">
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
				</div>
                <?php endforeach;?>
                <?php else : ?>
                    <div class="pi-text">
							<p>No Products Available!</p>
						</div>
                <?php endif;wp_reset_postdata(); ?> 
			</div>
           