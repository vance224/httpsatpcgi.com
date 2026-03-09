<?php
function architecturedesigner_footer( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	// Footer Panel // 
	$wp_customize->add_panel( 
		'footer_section', 
		array(
			'priority'      => 34,
			'capability'    => 'edit_theme_options',
			'title'			=> __('Footer', 'architecture-designer'),
		) 
	);
	

	// Footer Background // 
	$wp_customize->add_section(
        'footer_background',
        array(
            'title' 		=> __('Footer Top','architecture-designer'),
			'panel'  		=> 'footer_section',
			'priority'      => 1,
		)
    );
	
	
	// Background color // 


	// Layout tab

	// seaction width
	$wp_customize->add_setting('architecturedesigner_footer_section_width',array(
        'default' => 'Full Width',
        'sanitize_callback' => 'architecturedesigner_sanitize_choices',
    ));
    $wp_customize->add_control('architecturedesigner_footer_section_width',array(
        'type' => 'select',
        'label' => __('Footer Width','architecture-designer'),
        'choices' => array (
            'Box Width' => __('Box Width','architecture-designer'),
            'Full Width' => __('Full Width','architecture-designer')
        ),
        'section' => 'footer_background',
    ));

    
	// footer bg color 
	$footerbg = esc_html__('#07332e', 'architecture-designer' );
	$wp_customize->add_setting(
    	'footer_bg',
    	array(
			'default' => $footerbg,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 13,
		)
	);	

	$wp_customize->add_control( 
		'footer_bg',
		array(
		    'label'   		=> __('Footer BG Color','architecture-designer'),
		    'section'		=> 'footer_background',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);


	// footer icon color 
	$footericoncolor = esc_html__('#fff', 'architecture-designer' );
	$wp_customize->add_setting(
    	'footer_icon_color',
    	array(
			'default' => $footericoncolor,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 14,
		)
	);	

	$wp_customize->add_control( 
		'footer_icon_color',
		array(
		    'label'   		=> __('Icon Color','architecture-designer'),
		    'section'		=> 'footer_background',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);


	// footer list color 
	$footerlistcolor = esc_html__('#ebeeec', 'architecture-designer' );
	$wp_customize->add_setting(
    	'footer_list_color',
    	array(
			'default' => $footerlistcolor,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 15,
		)
	);	

	$wp_customize->add_control( 
		'footer_list_color',
		array(
		    'label'   		=> __('List Color','architecture-designer'),
		    'section'		=> 'footer_background',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);


	// footer list hover color 
	$footerlisthovercolor = esc_html__('#8a8a8a', 'architecture-designer' );
	$wp_customize->add_setting(
    	'footer_list_hover_color',
    	array(
			'default' => $footerlisthovercolor,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 16,
		)
	);	

	$wp_customize->add_control( 
		'footer_list_hover_color',
		array(
		    'label'   		=> __('List Hover Color','architecture-designer'),
		    'section'		=> 'footer_background',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);


	// footer Heading color 
	$footerHeadincolor = esc_html__('#fff', 'architecture-designer' );
	$wp_customize->add_setting(
    	'footer_Heading_color',
    	array(
			'default' => $footerHeadincolor,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 16,
		)
	);	

	$wp_customize->add_control( 
		'footer_Heading_color',
		array(
		    'label'   		=> __('Heading Color','architecture-designer'),
		    'section'		=> 'footer_background',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);

	// footer text color 
	$footertextcolor = esc_html__('#fff', 'architecture-designer' );
	$wp_customize->add_setting(
    	'footer_text_color',
    	array(
			'default' => $footertextcolor,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 16,
		)
	);	

	$wp_customize->add_control( 
		'footer_text_color',
		array(
		    'label'   		=> __('Text Color','architecture-designer'),
		    'section'		=> 'footer_background',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);




	
	// Footer Bottom // 
	$wp_customize->add_section(
        'footer_bottom',
        array(
            'title' 		=> __('Footer Bottom','architecture-designer'),
			'panel'  		=> 'footer_section',
			'priority'      => 2,
		)
    );
	
	// Footer Copyright Head
	$wp_customize->add_setting(
		'footer_btm_copy_head'
			,array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'architecturedesigner_sanitize_text',
			'priority'  => 3,
		)
	);

	$wp_customize->add_control(
	'footer_btm_copy_head',
		array(
			'type' => 'hidden',
			'label' => __('Copyright','architecture-designer'),
			'section' => 'footer_bottom',
		)
	);
	
	// Footer Copyright 
	$architecturedesigner_foo_copy = esc_html__('Copyright &copy; [current_year] [site_title] | Powered by [theme_author]', 'architecture-designer' );
	$wp_customize->add_setting(
    	'footer_copyright',
    	array(
			'default' => $architecturedesigner_foo_copy,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 4,
		)
	);	

	$wp_customize->add_control( 
		'footer_copyright',
		array(
		    'label'   		=> __('Copyright','architecture-designer'),
		    'section'		=> 'footer_bottom',
			'type' 			=> 'textarea',
			'transport'         => $selective_refresh,
		)  
	);


	// footer bottombg color 
	$footerbottombgcolor = esc_html__('#020202', 'architecture-designer' );
	$wp_customize->add_setting(
    	'footer_bottombg_color',
    	array(
			'default' => $footerbottombgcolor,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 5,
		)
	);	

	$wp_customize->add_control( 
		'footer_bottombg_color',
		array(
		    'label'   		=> __('BG Color','architecture-designer'),
		    'section'		=> 'footer_bottom',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);


	// footer bottomtext color 
	$footerbottomtextcolor = esc_html__('#fff', 'architecture-designer' );
	$wp_customize->add_setting(
    	'footer_bottomtext_color',
    	array(
			'default' => $footerbottomtextcolor,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 6,
		)
	);	

	$wp_customize->add_control( 
		'footer_bottomtext_color',
		array(
		    'label'   		=> __('Text Color','architecture-designer'),
		    'section'		=> 'footer_bottom',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);

	// footer bottomlink color 
	$footerbottomlinkcolor = esc_html__('#07332e', 'architecture-designer' );
	$wp_customize->add_setting(
    	'footer_bottomlink_color',
    	array(
			'default' => $footerbottomlinkcolor,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 7,
		)
	);	

	$wp_customize->add_control( 
		'footer_bottomlink_color',
		array(
		    'label'   		=> __('Link Color','architecture-designer'),
		    'section'		=> 'footer_bottom',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);


	// footer scrolltoparrow color 
	$footerscrolltoparrowcolor = esc_html__('#fff', 'architecture-designer' );
	$wp_customize->add_setting(
    	'footer_scrolltoparrow_color',
    	array(
			'default' => $footerscrolltoparrowcolor,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 8,
		)
	);	

	$wp_customize->add_control( 
		'footer_scrolltoparrow_color',
		array(
		    'label'   		=> __('Scroll Top Arrow Color','architecture-designer'),
		    'section'		=> 'footer_bottom',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);

	// footer scrolltopbg color 
	$footerscrolltopbgcolor = esc_html__('#0f332e', 'architecture-designer' );
	$wp_customize->add_setting(
    	'footer_scrolltopbg_color',
    	array(
			'default' => $footerscrolltopbgcolor,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 9,
		)
	);	

	$wp_customize->add_control( 
		'footer_scrolltopbg_color',
		array(
		    'label'   		=> __('Scroll Top BG Color','architecture-designer'),
		    'section'		=> 'footer_bottom',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);

	// footer scrolltopbghover color 
	$footerscrolltopbghovercolor = esc_html__('#0f332e', 'architecture-designer' );
	$wp_customize->add_setting(
    	'footer_scrolltopbghover_color',
    	array(
			'default' => $footerscrolltopbghovercolor,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 10,
		)
	);	

	$wp_customize->add_control( 
		'footer_scrolltopbghover_color',
		array(
		    'label'   		=> __('Scroll Top BG Hover Color','architecture-designer'),
		    'section'		=> 'footer_bottom',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);

}
add_action( 'customize_register', 'architecturedesigner_footer' );
// Footer selective refresh
function architecturedesigner_footer_partials( $wp_customize ){	
	// footer_copyright
	$wp_customize->selective_refresh->add_partial( 'footer_copyright', array(
		'selector'            => '.copy-right .copyright-text',
		'settings'            => 'footer_copyright',
		'render_callback'  => 'architecturedesigner_footer_copyright_render_callback',
	) );
	
	}
add_action( 'customize_register', 'architecturedesigner_footer_partials' );


// copyright_content
function architecturedesigner_footer_copyright_render_callback() {
	return get_theme_mod( 'footer_copyright' );
}