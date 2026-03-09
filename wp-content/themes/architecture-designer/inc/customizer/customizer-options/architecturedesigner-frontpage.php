<?php
function architecturedesigner_blog_setting( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	$wp_customize->add_panel(
		'architecturedesigner_frontpage_sections', array(
			'priority' => 32,
			'title' => esc_html__( 'Frontpage Sections', 'architecture-designer' ),
		)
	);
	
	/*=========================================
	Slider Section
	=========================================*/
	$wp_customize->add_section(
		'footer_setting', array(
			'title' => esc_html__( 'Footer Section', 'architecture-designer' ),
			'priority' => 12,
			'panel' => 'architecturedesigner_frontpage_sections',
		)
	);


	/*=========================================
	Slider Section
	=========================================*/
	$wp_customize->add_section(
		'slider_setting', array(
			'title' => esc_html__( 'Slider Section', 'architecture-designer' ),
			'priority' => 13,
			'panel' => 'architecturedesigner_frontpage_sections',
		)
	);

	

	$wp_customize->add_setting('architecturedesigner_slider_tabs', array(
	   'sanitize_callback' => 'wp_kses_post',
	));

	$wp_customize->add_control(new architecturedesigner_Tab_Control($wp_customize, 'architecturedesigner_slider_tabs', array(
	   'section' => 'slider_setting',
	   'priority' => 1,
	   'buttons' => array(
	      array(
         	'name' => esc_html__('General', 'architecture-designer'),
            'icon' => 'dashicons dashicons-welcome-write-blog',
            'fields' => array(
            	'slider_section_show_content',
            	'architecturedesigner_slider_image_opacity',
            	'slider1',
            	'slider2',
            	'slider3',
            	'slider4',
            	'slider5',
            	'slider_section_btntext'
            ),
            'active' => true,
         ),
	      array(
            'name' => esc_html__('Style', 'architecture-designer'),
        	'icon' => 'dashicons dashicons-art',
            'fields' => array(
            	'slider_heading_color',
            	'slider_text_color',
            	'slider_btntxt_color',
            	'slider_btn_color',
            	'slider_btn_hrv_color',
            	'slider_btn_hrv_txt_color',
            	'slider_btn_hrv_bor_color',
            	'slider_overlay_color',
            	'slider_boxborder_color'

            ),
     	),
      	array(
            'name' => esc_html__('Layout', 'architecture-designer'),
            'icon' => 'dashicons dashicons-layout',
            'fields' => array(
                'architecturedesigner_slider_section_width'
            ),
         )
	    
    	),
	))); 


	// General Tab

	// hide show slider box
	$wp_customize->add_setting(
        'slider_section_show_content',
        array(
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    $wp_customize->add_control(
        new architecturedesigner_Toggle_Switch_Custom_Control(
            $wp_customize,
            'slider_section_show_content',
            array(
                'settings'      => 'slider_section_show_content',
                'section'       => 'slider_setting',
                'label'         => __( 'Hide Box On Slider', 'architecture-designer' ),
                'on_off_label'  => array(
                    'on' => __( 'Yes', 'architecture-designer' ),
                    'off' => __( 'No', 'architecture-designer' )
                ),
            )
        )
    );


    // slider box opacity
    $wp_customize->add_setting('architecturedesigner_slider_image_opacity',array(
        'default' => 0.4,
        'sanitize_callback' => 'architecturedesigner_sanitize_float'
    ));
    $wp_customize->add_control(new architecturedesigner_Custom_Control( $wp_customize, 'architecturedesigner_slider_image_opacity',array(
    'label' => __('Slider Content Box Opacity','architecture-designer'),
    'section' => 'slider_setting',
    'input_attrs' => array(
            'min' => 0,
            'max' => 1,
            'step' => 0.1,
        ),
    )));


	// Slider 1
	$wp_customize->add_setting( 
    	'slider1',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 1,
		)
	);	

	$wp_customize->add_control( 
		'slider1',
		array(
		    'label'   		=> __('Slider 1','architecture-designer'),
		    'section'		=> 'slider_setting',
			'type' 			=> 'dropdown-pages',
			'transport'         => $selective_refresh,
		)  
	);		



	// Slider 2
	$wp_customize->add_setting(
    	'slider2',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 2,
		)
	);	

	$wp_customize->add_control( 
		'slider2',
		array(
		    'label'   		=> __('Slider 2','architecture-designer'),
		    'section'		=> 'slider_setting',
			'type' 			=> 'dropdown-pages',
			'transport'         => $selective_refresh,
		)  
	);	


	// Slider 3
	$wp_customize->add_setting(
    	'slider3',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 3,
		)
	);	

	$wp_customize->add_control( 
		'slider3',
		array(
		    'label'   		=> __('Slider 3','architecture-designer'),
		    'section'		=> 'slider_setting',
			'type' 			=> 'dropdown-pages',
			'transport'         => $selective_refresh,
		)  
	);	


	// Slider 4
	$wp_customize->add_setting(
    	'slider4',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 4,
		)
	);	

	$wp_customize->add_control( 
		'slider4',
		array(
		    'label'   		=> __('Slider 4','architecture-designer'),
		    'section'		=> 'slider_setting',
			'type' 			=> 'dropdown-pages',
			'transport'         => $selective_refresh,
		)  
	);



	// Slider 5
	$wp_customize->add_setting(
    	'slider5',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 5,
		)
	);	

	$wp_customize->add_control( 
		'slider5',
		array(
		    'label'   		=> __('Slider 5','architecture-designer'),
		    'section'		=> 'slider_setting',
			'type' 			=> 'dropdown-pages',
			'transport'         => $selective_refresh,
		)  
	);


	// section btntext 
	$slidersectionbtntext = esc_html__('Contact Us', 'architecture-designer' );
	$wp_customize->add_setting(
		'slider_section_btntext',
		array(
			'default' => $slidersectionbtntext,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 6,
		)
	);	

	$wp_customize->add_control( 
		'slider_section_btntext',
		array(
			'label'   		=> __('Button Text','architecture-designer'),
			'section'		=> 'slider_setting',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)  
	);	

		


	// Style tab

	// slider Heading color 
	$sliderheadingcolor = esc_html__('#fff', 'architecture-designer' );
	$wp_customize->add_setting(
    	'slider_heading_color',
    	array(
			'default' => $sliderheadingcolor,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 13,
		)
	);	

	$wp_customize->add_control( 
		'slider_heading_color',
		array(
		    'label'   		=> __('Title color','architecture-designer'),
		    'section'		=> 'slider_setting',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);


	// slider Text color 
	$slidertextcolor = esc_html__('#fff', 'architecture-designer' );
	$wp_customize->add_setting(
    	'slider_text_color',
    	array(
			'default' => $slidertextcolor,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 13,
		)
	);	

	$wp_customize->add_control( 
		'slider_text_color',
		array(
		    'label'   		=> __('Text color','architecture-designer'),
		    'section'		=> 'slider_setting',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);


	// slider button text color 
	$sliderbtntxtcolor = esc_html__('#06332e', 'architecture-designer' );
	$wp_customize->add_setting(
    	'slider_btntxt_color',
    	array(
			'default' => $sliderbtntxtcolor,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 13,
		)
	);	

	$wp_customize->add_control( 
		'slider_btntxt_color',
		array(
		    'label'   		=> __('Button Text color','architecture-designer'),
		    'section'		=> 'slider_setting',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);


	// slider Button color 
	$sliderbtncolor = esc_html__('#fdfdfd', 'architecture-designer' );
	$wp_customize->add_setting(
    	'slider_btn_color',
    	array(
			'default' => $sliderbtncolor,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 13,
		)
	);	

	$wp_customize->add_control( 
		'slider_btn_color',
		array(
		    'label'   		=> __('Button color','architecture-designer'),
		    'section'		=> 'slider_setting',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);


	// slider Button Hover color 
	$sliderbtnhvrcolor = esc_html__('#06332e', 'architecture-designer' );
	$wp_customize->add_setting(
    	'slider_btn_hrv_color',
    	array(
			'default' => $sliderbtnhvrcolor,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 13,
		)
	);	

	$wp_customize->add_control( 
		'slider_btn_hrv_color',
		array(
		    'label'   		=> __('Button Hover Color','architecture-designer'),
		    'section'		=> 'slider_setting',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);


	// slider Button Hover text color 
	$sliderbtnhvrtxtcolor = esc_html__('#fff', 'architecture-designer' );
	$wp_customize->add_setting(
    	'slider_btn_hrv_txt_color',
    	array(
			'default' => $sliderbtnhvrtxtcolor,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 13,
		)
	);	

	$wp_customize->add_control( 
		'slider_btn_hrv_txt_color',
		array(
		    'label'   		=> __('Button Hover Text Color','architecture-designer'),
		    'section'		=> 'slider_setting',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);


	// slider Button Hover Border Color
	$sliderbtnhrvborcol = esc_html__('#fdfdfd', 'architecture-designer' );
	$wp_customize->add_setting(
    	'slider_btn_hrv_bor_color',
    	array(
			'default' => $sliderbtnhrvborcol,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 13,
		)
	);	

	$wp_customize->add_control( 
		'slider_btn_hrv_bor_color',
		array(
		    'label'   		=> __('Button Hover Border Color','architecture-designer'),
		    'section'		=> 'slider_setting',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);


	

	// slider overlay color 
	$slideroverlaycolor = esc_html__('#000', 'architecture-designer' );
	$wp_customize->add_setting(
    	'slider_overlay_color',
    	array(
			'default' => $slideroverlaycolor,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 13,
		)
	);	

	$wp_customize->add_control( 
		'slider_overlay_color',
		array(
		    'label'   		=> __('Box Overlay color','architecture-designer'),
		    'section'		=> 'slider_setting',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);


	$sliderboxbordercolor = esc_html__('#fff', 'architecture-designer' );
	$wp_customize->add_setting(
    	'slider_boxborder_color',
    	array(
			'default' => $sliderboxbordercolor,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 13,
		)
	);	

	$wp_customize->add_control( 
		'slider_boxborder_color',
		array(
		    'label'   		=> __('Box Border color','architecture-designer'),
		    'section'		=> 'slider_setting',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);




	// layout setting

	$wp_customize->add_setting('architecturedesigner_slider_section_width',array(
        'default' => 'Full Width',
        'sanitize_callback' => 'architecturedesigner_sanitize_choices',
    ));
    $wp_customize->add_control('architecturedesigner_slider_section_width',array(
        'type' => 'select',
        'label' => __('Section Width','architecture-designer'),
        'choices' => array (
            'Box Width' => __('Box Width','architecture-designer'),
            'Full Width' => __('Full Width','architecture-designer')
        ),
        'section' => 'slider_setting',
    ));




	/*=========================================
	Service Section
	=========================================*/
	$wp_customize->add_section(
		'Service_setting', array(
			'title' => esc_html__( 'Service Section', 'architecture-designer' ),
			'priority' => 14,
			'panel' => 'architecturedesigner_frontpage_sections',
		)
	);



	$wp_customize->add_setting('architecturedesigner_service_tabs', array(
	   'sanitize_callback' => 'wp_kses_post',
	));

	$wp_customize->add_control(new architecturedesigner_Tab_Control($wp_customize, 'architecturedesigner_service_tabs', array(
	   'section' => 'Service_setting',
	   'priority' => 1,
	   'buttons' => array(
	      array(
         	'name' => esc_html__('General', 'architecture-designer'),
            'icon' => 'dashicons dashicons-welcome-write-blog',
            'fields' => array(
            	'service_show_content',
            	'service_section_heading',
            	'service_section_sub_heading',
            	'Service1',
            	'Service2',
            	'Service3',
            	'Service4',
            	'Service5',
            	'Service6'
            ),
            'active' => true,
         ),
	      array(
            'name' => esc_html__('Style', 'architecture-designer'),
        	'icon' => 'dashicons dashicons-art',
            'fields' => array(
            	'service_sechead_col',
            	'service_secsubhead_col',
            	'service_box_border',
            	'service_title_col',
            	'service_title_bg_col',
            	'service_title_box_opacity',
            	'service_text_col'

            ),
         ),
      	array(
            'name' => esc_html__('Layout', 'architecture-designer'),
            'icon' => 'dashicons dashicons-layout',
            'fields' => array(
            	'architecturedesigner_service_section_width',
            	'architecturedesigner_service_padding',
                'architecturedesigner_service_top_padding',
                'architecturedesigner_service_bottom_padding',
                'architecturedesigner_services_post_img_height'
            ),
         )
	    
    	),
	))); 


	// General tab


	// hide show service section
	$wp_customize->add_setting(
        'service_show_content',
        array(
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    $wp_customize->add_control(
        new architecturedesigner_Toggle_Switch_Custom_Control(
            $wp_customize,
            'service_show_content',
            array(
                'settings'      => 'service_show_content',
                'section'       => 'Service_setting',
                'label'         => __( 'Disable Section', 'architecture-designer' ),
                'on_off_label'  => array(
                    'on' => __( 'Yes', 'architecture-designer' ),
                    'off' => __( 'No', 'architecture-designer' )
                ),
            )
        )
    );

	// section heading 
	$servicesectionheading = esc_html__('Our Services', 'architecture-designer' );
	$wp_customize->add_setting(
    	'service_section_heading',
    	array(
			'default' => $servicesectionheading,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 6,
		)
	);	

	$wp_customize->add_control( 
		'service_section_heading',
		array(
		    'label'   		=> __('Section Heading','architecture-designer'),
		    'section'		=> 'Service_setting',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)  
	);	

	// section Sub heading 
	$servicesectionsubheading = esc_html__('What We Offer', 'architecture-designer' );
	$wp_customize->add_setting(
    	'service_section_sub_heading',
    	array(
			'default' => $servicesectionsubheading,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 6,
		)
	);	

	$wp_customize->add_control( 
		'service_section_sub_heading',
		array(
		    'label'   		=> __('Section Sub Heading','architecture-designer'),
		    'section'		=> 'Service_setting',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)  
	);	


	// Service 1
	$wp_customize->add_setting( 
    	'Service1',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 1,
		)
	);	

	$wp_customize->add_control( 
		'Service1',
		array(
		    'label'   		=> __('Service 1','architecture-designer'),
		    'section'		=> 'Service_setting',
			'type' 			=> 'dropdown-pages',
			'transport'         => $selective_refresh,
		)  
	);		



	// Service 2
	$wp_customize->add_setting(
    	'Service2',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 2,
		)
	);	

	$wp_customize->add_control( 
		'Service2',
		array(
		    'label'   		=> __('Service 2','architecture-designer'),
		    'section'		=> 'Service_setting',
			'type' 			=> 'dropdown-pages',
			'transport'         => $selective_refresh,
		)  
	);	


	// Service 3
	$wp_customize->add_setting(
    	'Service3',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 3,
		)
	);	

	$wp_customize->add_control( 
		'Service3',
		array(
		    'label'   		=> __('Service 3','architecture-designer'),
		    'section'		=> 'Service_setting',
			'type' 			=> 'dropdown-pages',
			'transport'         => $selective_refresh,
		)  
	);	


	// Service 4
	$wp_customize->add_setting(
    	'Service4',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 4,
		)
	);	 

	$wp_customize->add_control( 
		'Service4',
		array(
		    'label'   		=> __('Service 4','architecture-designer'),
		    'section'		=> 'Service_setting',
			'type' 			=> 'dropdown-pages',
			'transport'         => $selective_refresh,
		)  
	);



	// Service 5
	$wp_customize->add_setting(
    	'Service5',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 5,
		)
	);	

	$wp_customize->add_control( 
		'Service5',
		array(
		    'label'   		=> __('Service 5','architecture-designer'),
		    'section'		=> 'Service_setting',
			'type' 			=> 'dropdown-pages',
			'transport'         => $selective_refresh,
		)  
	);


	// Service 6
	$wp_customize->add_setting(
    	'Service6',
    	array(
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 5,
		)
	);	

	$wp_customize->add_control( 
		'Service6',
		array(
		    'label'   		=> __('Service 6','architecture-designer'),
		    'section'		=> 'Service_setting',
			'type' 			=> 'dropdown-pages',
			'transport'         => $selective_refresh,
		)  
	);



	// Style Tab

	// service section heading color 
	$servicesecheadcol = esc_html__('#11352f', 'architecture-designer' );
	$wp_customize->add_setting(
    	'service_sechead_col',
    	array(
			'default' => $servicesecheadcol,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 13,
		)
	);	

	$wp_customize->add_control( 
		'service_sechead_col',
		array(
		    'label'   		=> __('Section Heading Color','architecture-designer'),
		    'section'		=> 'Service_setting',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);


	// service section sub heading color 
	$servicesecsubheadcol = esc_html__('#010101', 'architecture-designer' );
	$wp_customize->add_setting(
    	'service_secsubhead_col',
    	array(
			'default' => $servicesecsubheadcol,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 13,
		)
	);	

	$wp_customize->add_control( 
		'service_secsubhead_col',
		array(
		    'label'   		=> __('Section Sub Heading Color','architecture-designer'),
		    'section'		=> 'Service_setting',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);

	// service box border color 
	$serviceboxbordercol = esc_html__('#ccc', 'architecture-designer' );
	$wp_customize->add_setting(
    	'service_box_border',
    	array(
			'default' => $serviceboxbordercol,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 13,
		)
	);	

	$wp_customize->add_control( 
		'service_box_border',
		array(
		    'label'   		=> __('Box Border Color','architecture-designer'),
		    'section'		=> 'Service_setting',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);


	// service Title Color 
	$servicetitlecol = esc_html__('#31514d', 'architecture-designer' );
	$wp_customize->add_setting(
    	'service_title_col',
    	array(
			'default' => $servicetitlecol,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 13,
		)
	);	

	$wp_customize->add_control( 
		'service_title_col',
		array(
		    'label'   		=> __('Title Color','architecture-designer'),
		    'section'		=> 'Service_setting',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);


	// service Title BG Color 
	$servicetitlebgcol = esc_html__('#cccccc', 'architecture-designer' );
	$wp_customize->add_setting(
    	'service_title_bg_col',
    	array(
			'default' => $servicetitlebgcol,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 13,
		)
	);	

	$wp_customize->add_control( 
		'service_title_bg_col',
		array(
		    'label'   		=> __('Title BG Color','architecture-designer'),
		    'section'		=> 'Service_setting',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);


	// service title bg opacity
    $wp_customize->add_setting('service_title_box_opacity',array(
        'default' => 0.6,
        'sanitize_callback' => 'architecturedesigner_sanitize_float'
    ));
    $wp_customize->add_control(new architecturedesigner_Custom_Control( $wp_customize, 'service_title_box_opacity',array(
	    'label' => __('Title Box Opacity','architecture-designer'),
	    'section' => 'Service_setting',
	    'input_attrs' => array(
	            'min' => 0,
	            'max' => 1,
	            'step' => 0.1,
        	),
    )));


	// service Text Color 
	$servicetextcol = esc_html__('#a1a1a1', 'architecture-designer' );
	$wp_customize->add_setting(
    	'service_text_col',
    	array(
			'default' => $servicetextcol,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 13,
		)
	);	

	$wp_customize->add_control( 
		'service_text_col',
		array(
		    'label'   		=> __('Text Color','architecture-designer'),
		    'section'		=> 'Service_setting',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);




	// Layout tab

	// seaction width
	$wp_customize->add_setting('architecturedesigner_service_section_width',array(
        'default' => 'Box Width',
        'sanitize_callback' => 'architecturedesigner_sanitize_choices',
    ));
    $wp_customize->add_control('architecturedesigner_service_section_width',array(
        'type' => 'select',
        'label' => __('Section Width','architecture-designer'),
        'choices' => array (
            'Box Width' => __('Box Width','architecture-designer'),
            'Full Width' => __('Full Width','architecture-designer')
        ),
        'section' => 'Service_setting',
    ));


	// service section padding 
	$wp_customize->add_setting('architecturedesigner_service_padding',array(
      'sanitize_callback'   => 'esc_html'
    ));
    $wp_customize->add_control('architecturedesigner_service_padding',array(
      'label' => __('Section Padding','architecture-designer'),
      'section' => 'Service_setting'
    ));

    $wp_customize->add_setting('architecturedesigner_service_top_padding',array(
        'default' => '5',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('architecturedesigner_service_top_padding',array(
	    'type' => 'number',
	    'label' => __('Top','architecture-designer'),
	    'section' => 'Service_setting',
    ));

 	$wp_customize->add_setting('architecturedesigner_service_bottom_padding',array(
        'default' => '4',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('architecturedesigner_service_bottom_padding',array(
	    'type' => 'number',
	    'label' => __('Bottom','architecture-designer'),
	    'section' => 'Service_setting',
    ));


    // image height 
    $wp_customize->add_setting('architecturedesigner_services_post_img_height',array(
        'default' => 380,
        'sanitize_callback' => 'architecturedesigner_sanitize_float'
    ));
    $wp_customize->add_control(new architecturedesigner_Custom_Control( $wp_customize, 'architecturedesigner_services_post_img_height',array(
	    'label' => __('Image Height','architecture-designer'),
	    'section' => 'Service_setting',
	    'input_attrs' => array(
            'min' => 0,
            'max' => 500,
            'step' => 1,
        ),
    )));






	/*=========================================
	Blog Section
	=========================================*/
	$wp_customize->add_section(
		'blog_setting', array(
			'title' => esc_html__( 'Blog Section', 'architecture-designer' ),
			'priority' => 14,
			'panel' => 'architecturedesigner_frontpage_sections',
		)
	);



	$wp_customize->add_setting('architecturedesigner_blog_tabs', array(
	   'sanitize_callback' => 'wp_kses_post',
	));

	$wp_customize->add_control(new architecturedesigner_Tab_Control($wp_customize, 'architecturedesigner_blog_tabs', array(
	   'section' => 'blog_setting',
	   'priority' => 1,
	   'buttons' => array(
	      array(
         	'name' => esc_html__('General', 'architecture-designer'),
            'icon' => 'dashicons dashicons-welcome-write-blog',
            'fields' => array(
            	'blog_show_content',
            	'blog_section_heading',
            	'blog_section_sub_heading',
				'blog_section_btntext'
            ),
            'active' => true,
         ),
	      array(
            'name' => esc_html__('Style', 'architecture-designer'),
        	'icon' => 'dashicons dashicons-art',
            'fields' => array(
            	'blog_sechead_col',
            	'blog_secsubhead_col',
            	'blog_title_col',
            	'blog_text_col',
            	'blog_btn_text_col',
            	'blog_btn_col',
            	'blog_btn_hrv_bor_col',
            	'blog_adminandcommicon_col',
            	'blog_adminandcommtxt_col',
            	'blog_date_col',
            	'blog_date_bg_col',
            	'blog_box_border_color'

            ),
         ),
      	array(
            'name' => esc_html__('Layout', 'architecture-designer'),
            'icon' => 'dashicons dashicons-layout',
            'fields' => array(
            	'architecturedesigner_blog_section_width',
            	'architecturedesigner_blog_padding',
                'architecturedesigner_blog_section_t_padding',
                'architecturedesigner_blog_section_b_padding',
                'architecturedesigner_blog_post_img_height'
            ),
         )
	    
    	),
	))); 



	// General tab

	// hide show blog section
	$wp_customize->add_setting(
        'blog_show_content',
        array(
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    $wp_customize->add_control(
        new architecturedesigner_Toggle_Switch_Custom_Control(
            $wp_customize,
            'blog_show_content',
            array(
                'settings'      => 'blog_show_content',
                'section'       => 'blog_setting',
                'label'         => __( 'Disable Section', 'architecture-designer' ),
                'on_off_label'  => array(
                    'on' => __( 'Yes', 'architecture-designer' ),
                    'off' => __( 'No', 'architecture-designer' )
                ),
            )
        )
    );


	// section heading 
	$blogsectionheading = esc_html__('Our Blog', 'architecture-designer' );
	$wp_customize->add_setting(
    	'blog_section_heading',
    	array(
			'default' => $blogsectionheading,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 6,
		)
	);	

	$wp_customize->add_control( 
		'blog_section_heading',
		array(
		    'label'   		=> __('Section Heading','architecture-designer'),
		    'section'		=> 'blog_setting',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)  
	);	

	// section Sub heading 
	$blogsectionsubheading = esc_html__('Latest From Our News', 'architecture-designer' );
	$wp_customize->add_setting(
    	'blog_section_sub_heading',
    	array(
			'default' => $blogsectionsubheading,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 6,
		)
	);	

	$wp_customize->add_control( 
		'blog_section_sub_heading',
		array(
		    'label'   		=> __('Section Sub Heading','architecture-designer'),
		    'section'		=> 'blog_setting',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)  
	);	


	// blog section bnttext 
	$blogsectionbnttext = esc_html__('Read More', 'architecture-designer' );
	$wp_customize->add_setting(
    	'blog_section_btntext',
    	array(
			'default' => $blogsectionbnttext,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 6,
		)
	);	

	$wp_customize->add_control( 
		'blog_section_btntext',
		array(
		    'label'   		=> __('Button Text','architecture-designer'),
		    'section'		=> 'blog_setting',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)  
	);	



	// Style Tab

	// blog section heading color 
	$blogsecheadcol = esc_html__('#11352f', 'architecture-designer' );
	$wp_customize->add_setting(
    	'blog_sechead_col',
    	array(
			'default' => $blogsecheadcol,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 13,
		)
	);	

	$wp_customize->add_control( 
		'blog_sechead_col',
		array(
		    'label'   		=> __('Section Heading Color','architecture-designer'),
		    'section'		=> 'blog_setting',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);


	// blog section sub heading color 
	$blogsecsubheadcol = esc_html__('#010101', 'architecture-designer' );
	$wp_customize->add_setting(
    	'blog_secsubhead_col',
    	array(
			'default' => $blogsecsubheadcol,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 13,
		)
	);	

	$wp_customize->add_control( 
		'blog_secsubhead_col',
		array(
		    'label'   		=> __('Section Sub Heading Color','architecture-designer'),
		    'section'		=> 'blog_setting',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);


	// blog Title Color 
	$blogtitlecol = esc_html__('#000', 'architecture-designer' );
	$wp_customize->add_setting(
    	'blog_title_col',
    	array(
			'default' => $blogtitlecol,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 13,
		)
	);	

	$wp_customize->add_control( 
		'blog_title_col',
		array(
		    'label'   		=> __('Title Color','architecture-designer'),
		    'section'		=> 'blog_setting',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);


	// blog Text Color 
	$blogtextcol = esc_html__('#b4b6b5', 'architecture-designer' );
	$wp_customize->add_setting(
    	'blog_text_col',
    	array(
			'default' => $blogtextcol,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 13,
		)
	);	

	$wp_customize->add_control( 
		'blog_text_col',
		array(
		    'label'   		=> __('Text Color','architecture-designer'),
		    'section'		=> 'blog_setting',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);


	// blog button Text Color 
	$blogbtntextcol = esc_html__('#fff', 'architecture-designer' );
	$wp_customize->add_setting(
    	'blog_btn_text_col',
    	array(
			'default' => $blogbtntextcol,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 13,
		)
	);	

	$wp_customize->add_control( 
		'blog_btn_text_col',
		array(
		    'label'   		=> __('Button Text Color','architecture-designer'),
		    'section'		=> 'blog_setting',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);

	// blog button Color 
	$blogbtncol = esc_html__('#06332e', 'architecture-designer' );
	$wp_customize->add_setting(
    	'blog_btn_col',
    	array(
			'default' => $blogbtncol,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 13,
		)
	);	

	$wp_customize->add_control( 
		'blog_btn_col',
		array(
		    'label'   		=> __('Button Color','architecture-designer'),
		    'section'		=> 'blog_setting',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);


	// blog button hover Color 
	$blogbtnhrvcol = esc_html__('#fff', 'architecture-designer' );
	$wp_customize->add_setting(
    	'blog_btn_hrv_bor_col',
    	array(
			'default' => $blogbtnhrvcol,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 13,
		)
	);	

	$wp_customize->add_control( 
		'blog_btn_hrv_bor_col',
		array(
		    'label'   		=> __('Button Hover Border Color','architecture-designer'),
		    'section'		=> 'blog_setting',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);




	// Blog Admin & comment Text Color 
	$blogadminandcommtxtcol = esc_html__('#06332e', 'architecture-designer' );
	$wp_customize->add_setting(
    	'blog_adminandcommtxt_col',
    	array(
			'default' => $blogadminandcommtxtcol,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 13,
		)
	);	

	$wp_customize->add_control( 
		'blog_adminandcommtxt_col',
		array(
		    'label'   		=> __('Admin & Comment Text color','architecture-designer'),
		    'section'		=> 'blog_setting',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);


	// Blog Admin & comment icon Color 
	$blogadminandcommiconcol = esc_html__('#07332e', 'architecture-designer' );
	$wp_customize->add_setting(
    	'blog_adminandcommicon_col',
    	array(
			'default' => $blogadminandcommiconcol,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 13,
		)
	);	

	$wp_customize->add_control( 
		'blog_adminandcommicon_col',
		array(
		    'label'   		=> __('Admin & Comment Icon color','architecture-designer'),
		    'section'		=> 'blog_setting',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);

	// Blog Date Color 
	$blogdatecol = esc_html__('#07332e', 'architecture-designer' );
	$wp_customize->add_setting(
    	'blog_date_col',
    	array(
			'default' => $blogdatecol,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 13,
		)
	);	

	$wp_customize->add_control( 
		'blog_date_col',
		array(
		    'label'   		=> __('Date color','architecture-designer'),
		    'section'		=> 'blog_setting',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);

	// Blog Date bg Color 
	$blogdatebgcol = esc_html__('#eae4e4', 'architecture-designer' );
	$wp_customize->add_setting(
    	'blog_date_bg_col',
    	array(
			'default' => $blogdatebgcol,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 13,
		)
	);	

	$wp_customize->add_control( 
		'blog_date_bg_col',
		array(
		    'label'   		=> __('Date BG color','architecture-designer'),
		    'section'		=> 'blog_setting',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);

	// Blog Box Border Color 
	$blogboxbordercol = esc_html__('#b4b5b0', 'architecture-designer' );
	$wp_customize->add_setting(
    	'blog_box_border_color',
    	array(
			'default' => $blogboxbordercol,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 13,
		)
	);	

	$wp_customize->add_control( 
		'blog_box_border_color',
		array(
		    'label'   		=> __('Box Border Color','architecture-designer'),
		    'section'		=> 'blog_setting',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);




	// Layout tab

	// seaction width
	$wp_customize->add_setting('architecturedesigner_blog_section_width',array(
        'default' => 'Box Width',
        'sanitize_callback' => 'architecturedesigner_sanitize_choices',
    ));
    $wp_customize->add_control('architecturedesigner_blog_section_width',array(
        'type' => 'select',
        'label' => __('Section Width','architecture-designer'),
        'choices' => array (
            'Box Width' => __('Box Width','architecture-designer'),
            'Full Width' => __('Full Width','architecture-designer')
        ),
        'section' => 'blog_setting',
    ));

	// blog section padding 
	$wp_customize->add_setting('architecturedesigner_blog_padding',array(
      'sanitize_callback'   => 'esc_html'
    ));
    $wp_customize->add_control('architecturedesigner_blog_padding',array(
      'label' => __('Section Padding','architecture-designer'),
      'section' => 'blog_setting'
    ));

    $wp_customize->add_setting('architecturedesigner_blog_section_t_padding',array(
        'default' => '5',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('architecturedesigner_blog_section_t_padding',array(
	    'type' => 'number',
	    'label' => __('Top','architecture-designer'),
	    'section' => 'blog_setting',
    ));

 	$wp_customize->add_setting('architecturedesigner_blog_section_b_padding',array(
        'default' => '4',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('architecturedesigner_blog_section_b_padding',array(
	    'type' => 'number',
	    'label' => __('Bottom','architecture-designer'),
	    'section' => 'blog_setting',
    ));


    // image height 
    $wp_customize->add_setting('architecturedesigner_blog_post_img_height',array(
        'default' => 225,
        'sanitize_callback' => 'architecturedesigner_sanitize_float'
    ));
    $wp_customize->add_control(new architecturedesigner_Custom_Control( $wp_customize, 'architecturedesigner_blog_post_img_height',array(
	    'label' => __('Image Height','architecture-designer'),
	    'section' => 'blog_setting',
	    'input_attrs' => array(
            'min' => 0,
            'max' => 500,
            'step' => 1,
        ),
    )));


	$wp_customize->register_control_type('architecturedesigner_Tab_Control');




}

add_action( 'customize_register', 'architecturedesigner_blog_setting' );

// service selective refresh
function architecturedesigner_blog_section_partials( $wp_customize ){	
	// blog_title
	$wp_customize->selective_refresh->add_partial( 'blog_title', array(
		'selector'            => '.home-blog .title h6',
		'settings'            => 'blog_title',
		'render_callback'  => 'architecturedesigner_blog_title_render_callback',
	
	) );
	
	// blog_subtitle
	$wp_customize->selective_refresh->add_partial( 'blog_subtitle', array(
		'selector'            => '.home-blog .title h2',
		'settings'            => 'blog_subtitle',
		'render_callback'  => 'architecturedesigner_blog_subtitle_render_callback',
	
	) );
	
	// blog_description
	$wp_customize->selective_refresh->add_partial( 'blog_description', array(
		'selector'            => '.home-blog .title p',
		'settings'            => 'blog_description',
		'render_callback'  => 'architecturedesigner_blog_description_render_callback',
	
	) );	
	}

add_action( 'customize_register', 'architecturedesigner_blog_section_partials' );

// blog_title
function architecturedesigner_blog_title_render_callback() {
	return get_theme_mod( 'blog_title' );
}

// blog_subtitle
function architecturedesigner_blog_subtitle_render_callback() {
	return get_theme_mod( 'blog_subtitle' );
}

// service description
function architecturedesigner_blog_description_render_callback() {
	return get_theme_mod( 'blog_description' );
}


