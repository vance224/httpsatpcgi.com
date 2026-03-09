<?php



// Load the JS and CSS.
add_action( 'customize_controls_enqueue_scripts', function() {

	$version = wp_get_theme()->get( 'Version' );

	wp_enqueue_script(
		'architecturedesigner-customize-section-button',
		get_theme_file_uri( 'assets/js/customize-controls.js' ),
		[ 'customize-controls' ],
		$version,
		true
	);
	wp_localize_script(
		'architecturedesigner-customize-section-button',
		'architecturedesigner_customizer_params',
		array(
			'ajaxurl' =>	admin_url( 'admin-ajax.php' )
		)
	);

	wp_enqueue_style(
		'architecturedesigner-customize-section-button',
		get_theme_file_uri( 'assets/css/customize-controls.css' ),
		[ 'customize-controls' ],
 		$version
	);

} );

 /**
 * Enqueue scripts and styles.
 */
function architecturedesigner_scripts() {
	
	// Styles	

	wp_enqueue_style('all-min',get_template_directory_uri().'/assets/css/all.min.css');

	wp_enqueue_style('swiper-min',get_template_directory_uri().'/assets/css/swiper.min.css');



	wp_enqueue_style('bootstrap-min',get_template_directory_uri().'/assets/css/bootstrap.min.css');
	
	wp_enqueue_style('owl-carousel-min',get_template_directory_uri().'/assets/css/owl.carousel.min.css');
	
	wp_enqueue_style('font-awesome',get_template_directory_uri().'/assets/css/fonts/font-awesome/css/font-awesome.min.css');
	
	wp_enqueue_style('animate',get_template_directory_uri().'/assets/css/animate.css');
	
	wp_enqueue_style('architecturedesigner-editor-style',get_template_directory_uri().'/assets/css/editor-style.css');

	wp_enqueue_style('architecturedesigner-main', get_template_directory_uri() . '/assets/css/main.css');

	wp_enqueue_style('menus-toggle', get_template_directory_uri() . '/assets/css/menus.toggle.css');

	wp_enqueue_style('architecturedesigner-woo', get_template_directory_uri() . '/assets/css/woo.css');
	
	wp_enqueue_style( 'architecturedesigner-style', get_stylesheet_uri() );
	
	// Scripts
	wp_enqueue_script( 'jquery' );


    wp_enqueue_script('sliderscript', get_template_directory_uri().'/assets/js/sliderscript.js', array(), '1.1', true);

	wp_enqueue_script('swiper', get_template_directory_uri() . '/assets/js/swiper.min.js', array('jquery'), true);

	wp_enqueue_script('jquery', get_template_directory_uri() . '/assets/js/jquery.min.js', array('jquery'), true);

	wp_enqueue_script( 'menus-toggle-js', get_template_directory_uri() . '/assets/js/menus.toggle.js', array('jquery'), '20150903', true );

	
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array('jquery'), false, true);

	wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array('jquery'), false, true);
	
	wp_enqueue_script('wow-min', get_template_directory_uri() . '/assets/js/wow.min.js', array('jquery'), false, false, true);

	wp_enqueue_script('architecturedesigner-custom-js', get_template_directory_uri() . '/assets/js/theme.js', array('jquery'), false, true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'architecturedesigner_scripts' );

//Admin Enqueue for Admin
function architecturedesigner_admin_enqueue_scripts(){
	wp_enqueue_style('architecturedesigner-admin-style', get_template_directory_uri() . '/inc/customizer/assets/css/admin.css');
	wp_enqueue_script( 'architecturedesigner-admin-script', get_template_directory_uri() . '/inc/customizer/assets/js/architecturedesigner-admin-script.js', array( 'jquery' ), '', true );
    wp_localize_script( 'architecturedesigner-admin-script', 'architecturedesigner_ajax_object',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
    );
}
add_action( 'admin_enqueue_scripts', 'architecturedesigner_admin_enqueue_scripts' );

