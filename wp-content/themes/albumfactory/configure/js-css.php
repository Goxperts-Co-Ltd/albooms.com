<?php
	
	function _add_stylesheets()
	{
		wp_enqueue_style('onlinefont-min-css', 'https://fonts.googleapis.com/css?family=Josefin+Sans:300,300i,400,400i,700,700i', array(), null, 'all' );
		wp_enqueue_style('bootstrap-min-css', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), null, 'all' );	
		wp_enqueue_style('fontawesome-css', get_template_directory_uri() .'/assets/css/font-awesome.min.css', array(), null,'all'); 
		wp_enqueue_style('main-css', get_template_directory_uri() . '/assets/css/flaticon.css', array(), null, 'all' );
  		wp_enqueue_style('mobirise-css', get_template_directory_uri() . '/assets/css/slicknav.min.css', array(), null, 'all' );
  		wp_enqueue_style('tether-css', get_template_directory_uri() . '/assets/css/jquery-ui.min.css', array(), null, 'all' );
  		wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/assets/css/owl.carousel.min.css', array(), null, 'all' );
  		wp_enqueue_style('bootstrap-grid', get_template_directory_uri() . '/assets/css/animate.css', array(), null, 'all' );
  		wp_enqueue_style('bootstrap-reboot', get_template_directory_uri() . '/assets/css/style.css', array(), null, 'all' );
	}
	add_action('wp_enqueue_scripts', '_add_stylesheets');

	function _add_javascript()
	{
		
  
		  wp_enqueue_script('jquery-assets', get_template_directory_uri() . '/assets/js/jquery-3.2.1.min.js', array(), null, true );
		  wp_enqueue_script('popper-js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), null, true );
		  wp_enqueue_script('tether-js', get_template_directory_uri() . '/assets/js/jquery.slicknav.min.js', array(), null, true );
		  wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array(), null, true );
		  wp_enqueue_script('smoothdcrool-js', get_template_directory_uri() . '/assets/js/jquery.nicescroll.min.js', array(), null, true );
		  wp_enqueue_script('dropdown-js', get_template_directory_uri() . '/assets/js/jquery.zoom.min.js', array(), null, true );
		  wp_enqueue_script('touch-swipe-js', get_template_directory_uri() . '/assets/js/jquery-ui.min.js', array(), null, true );
		  wp_enqueue_script('vimeo-js', get_template_directory_uri() . '/assets/js/main.js', array(), null, true );
		 	
	}
	add_action('wp_enqueue_scripts', '_add_javascript', 100);

