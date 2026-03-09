<?php
function architecturedesigner_innerpage( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	// innerpage Panel // 
	$wp_customize->add_panel( 
		'innerpage_section', 
		array(
			'priority'      => 34,
			'capability'    => 'edit_theme_options',
			'title'			=> __('Inner Pages', 'architecture-designer'),
		) 
	);
	
    /*=========================================
	Pages Section
	=========================================*/
	$wp_customize->add_section(
		'pages_setting', array(
			'title' => esc_html__( 'Pages Section', 'architecture-designer' ),
			'priority' => 12,
			'panel' => 'innerpage_section',
		)
	);
	
	// heading color // 
    
	// innerpage heading color 
	$innerpageheading = esc_html__('#fff', 'architecture-designer' );
	$wp_customize->add_setting(
    	'innerpage_heading',
    	array(
			'default' => $innerpageheading,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 1,
		)
	);	

	$wp_customize->add_control( 
		'innerpage_heading',
		array(
		    'label'   		=> __('Heading Color','architecture-designer'),
		    'section'		=> 'pages_setting',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);


}
add_action( 'customize_register', 'architecturedesigner_innerpage' );
