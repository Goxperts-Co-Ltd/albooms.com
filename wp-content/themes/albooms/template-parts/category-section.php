
<?php
global $post;
global $product;
$terms = get_the_terms( $post->ID, 'product_cat');
if(is_array($terms)){

	foreach ( $terms as $term ) {
	$product_cat_id = $term->term_id;
	//do nothing here
	break;
 }
}
$args = array(
	'taxonomy'     => 'product_cat',
	'orderby'      => '',
	'show_count'   => 0,
	'pad_counts'   => 0,
	'hierarchical' => 1,
	'title_li'     => '',
	'hide_empty'   => 1,
	'parent'       => 0,
);
$prod_categories = get_terms( $args);
?>  
    
<section class="category-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 order-2 order-lg-1">
					<div class="filter-widget">
						<h2 class="fw-title">Categories</h2>
						<ul class="category-menu">
						<?php foreach( $prod_categories as $prod_cat ) :
							$term_link = get_term_link( $prod_cat, 'product_cat' ); ?>
							<!-- only works in category page -->
							<?php if(is_product_category()) : ?>
								<!-- set active is current category -->
								<?php if($product_cat_id == $prod_cat->term_id) : ?>
									<li class="active-item">
								<?php else : ?>
									<li>
								<?php endif;?>
							<?php else : ?>
								<li>
							<?php endif;?>		
								<a href="<?php echo $term_link; ?>"><?php echo $prod_cat->name; ?></a>
								<!-- <ul class="sub-menu">
									<li><a href="#">Midi Dresses <span>(2)</span></a></li>
								</ul> -->
							</li>
						<?php endforeach; wp_reset_query();?>
						</ul>
					</div>
					
				</div>