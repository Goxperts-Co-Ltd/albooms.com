
<?php
get_header();
?>

<?php if(is_product_category()) :?>
    <!-- SHOP Category Page -->
	<?php get_template_part( 'template-parts/shop-category'); ?>
	<!-- End of SHOP Category Page -->
<?php else : ?>
	 <!-- SHOP Products -->
	 <?php get_template_part( 'template-parts/shop'); ?>
     <!-- End of Shop Products -->
<?php endif; ?>

<?php
get_footer();