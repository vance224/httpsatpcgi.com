<?php
function architecturedesigner_header_settings( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	/*=========================================
	Header Settings Panel
	=========================================*/
	$wp_customize->add_panel( 
		'header_section', 
		array(
			'priority'      => 2,
			'capability'    => 'edit_theme_options',
			'title'			=> __('Header', 'architecture-designer'),
		) 
	);

	
	/*=========================================
	Architecture Designer Site Identity
	=========================================*/
	$wp_customize->add_section(
        'title_tagline',
        array(
        	'priority'      => 1,
            'title' 		=> __('Site Identity','architecture-designer'),
			'panel'  		=> 'header_section',
		)
    );


	// // topheader Logo Width
	// $topheaderlogowidth = esc_html__('100', 'architecture-designer' );
	// $wp_customize->add_setting(
 //    	'topheader_logowidth',
 //    	array(
	// 		'default' => $topheaderlogowidth,
	// 		'capability'     	=> 'edit_theme_options',
	// 		'sanitize_callback' => 'wp_kses_post',
	// 		'priority'      => 2,
	// 	)
	// );	

	// $wp_customize->add_control( 
	// 	'topheader_logowidth',
	// 	array(
	// 	    'label'   		=> __('Logo Width','architecture-designer'),
	// 	    'section'		=> 'title_tagline',
	// 		'type' 			=> 'range',
	// 		'transport'         => $selective_refresh,
	// 	)  
	// );


	// topheader Logo Width
    $wp_customize->add_setting('topheader_logowidth',array(
        'default' => 100,
        'sanitize_callback' => 'architecturedesigner_sanitize_float'
    ));
    $wp_customize->add_control(new architecturedesigner_Custom_Control( $wp_customize, 'topheader_logowidth',array(
	    'label' => __('Logo Width','architecture-designer'),
	    'section' => 'title_tagline',
	    'input_attrs' => array(
	            'min' => 0,
	            'max' => 500,
	            'step' => 1,
	        ),
    )));


	// top header Site Title Color
	$topheadersitetitlecol = esc_html__('#646464', 'architecture-designer' );
	$wp_customize->add_setting(
    	'topheader_sitetitlecol',
    	array(
			'default' => $topheadersitetitlecol,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 3,
		)
	);	

	$wp_customize->add_control( 
		'topheader_sitetitlecol',
		array(
		    'label'   		=> __('Site Title Color','architecture-designer'),
		    'section'		=> 'title_tagline',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);


	// top header Tagline Color
	$topheadertaglinecol = esc_html__('#9a9e9e', 'architecture-designer' );
	$wp_customize->add_setting(
    	'topheader_taglinecol',
    	array(
			'default' => $topheadertaglinecol,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 4,
		)
	);	

	$wp_customize->add_control( 
		'topheader_taglinecol',
		array(
		    'label'   		=> __('Tagline Color','architecture-designer'),
		    'section'		=> 'title_tagline',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);

	// top header boxbg Color
	$topheaderboxbgcol = esc_html__('#fff', 'architecture-designer' );
	$wp_customize->add_setting(
    	'topheader_boxbgcol',
    	array(
			'default' => $topheaderboxbgcol,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 5,
		)
	);	

	$wp_customize->add_control( 
		'topheader_boxbgcol',
		array(
		    'label'   		=> __('Box BG Color','architecture-designer'),
		    'section'		=> 'title_tagline',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);


	/*=========================================
	Architecture Designer header
	=========================================*/
	$wp_customize->add_section(
        'top_header',
        array(
        	'priority'      => 5,
            'title' 		=> __('Header','architecture-designer'),
			'panel'  		=> 'header_section',
		)
    );	


    $wp_customize->add_setting('architecturedesigner_top_header_tabs', array(
	   'sanitize_callback' => 'wp_kses_post',
	));

	$wp_customize->add_control(new architecturedesigner_Tab_Control($wp_customize, 'architecturedesigner_top_header_tabs', array(
	   'section' => 'top_header',
	   'priority' => 1,
	   'buttons' => array(
	      array(
     		'name' => esc_html__('General', 'architecture-designer'),
 			'icon' => 'dashicons dashicons-welcome-write-blog',
            'fields' => array(
            	'hide_show_sticky',
				'header_menufontsize',
            	'topheader_emailicon',
            	'topheader_emailtext',
            	'topheader_mobicon',
            	'topheader_mobtext',
            	'header_icon1',
            	'header_icon1link',
            	'header_icon2',
            	'header_icon2link',
            	'header_icon3',
            	'header_icon3link',
            	'header_icon4',
    			'header_icon4link',
            	'header_icon5',
            	'header_icon5link',

            ),
            'active' => true,
         ),
	      array(
            'name' => esc_html__('Style', 'architecture-designer'),
            'icon' => 'dashicons dashicons-art',
            'fields' => array(
            	'topheader_bgcol',
            	'topheader_iconcol',
            	'topheader_iconbordercol',
            	'topheader_colortext',
            	'header_iconcol',
            	'header_bg_iconcol',
            	'menu_color',
            	'menuarrow_color',
            	'menuhover_color',
            	'submenutext_color',
            	'submenubg_color',
            	'submenutexthover_color',
            	'submenubghover_color',
            	'submenuborder_color',
            	'menutoggle_color',
				'mobielmenubg_color',
				'mobielmenuborder_color'

            ),
		),
		array(
            'name' => esc_html__('Layout', 'architecture-designer'),
            'icon' => 'dashicons dashicons-layout',
            'fields' => array(
                'architecturedesigner_header_section_width'
            ),
         )
	    
    	),
	)));


	// general setting

	// sticky header
	$wp_customize->add_setting( 'hide_show_sticky',array(
        'default' => false,
        'sanitize_callback' => 'architecturedesigner_switch_sanitization'
   	) );
   	$wp_customize->add_control( new architecturedesigner_Toggle_Switch_Custom_Control( $wp_customize, 'hide_show_sticky',array(
        'label' => __( 'Show Sticky Header','architecture-designer' ),
        'section' => 'top_header'
   	)));

	// Header Menu font size 
    $wp_customize->add_setting('header_menufontsize',array(
        'default' => 16,
        'sanitize_callback' => 'architecturedesigner_sanitize_float'
    ));
    $wp_customize->add_control(new architecturedesigner_Custom_Control( $wp_customize, 'header_menufontsize',array(
	    'label' => __('Menu Font Size','architecture-designer'),
	    'section' => 'top_header',
	    'input_attrs' => array(
            'min' => 0,
            'max' => 50,
            'step' => 1,
        ),
    )));

    // topheader icon 1
	$topheaderemailicon = esc_html__('fa fa-envelope-o', 'architecture-designer' );
	$wp_customize->add_setting(
    	'topheader_emailicon',
    	array(
			'default' => $topheaderemailicon,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 5,
		)
	);	

	$wp_customize->add_control( 
		'topheader_emailicon',
		array(
		    'label'   		=> __('Email Icon','architecture-designer'),
		    'section'		=> 'top_header',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)  
	);




	// topheader text 1
	$topheaderemailtext = esc_html__('info@yourmail.com', 'architecture-designer' );
	$wp_customize->add_setting(
    	'topheader_emailtext',
    	array(
			'default' => $topheaderemailtext,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 6,
		)
	);	

	$wp_customize->add_control( 
		'topheader_emailtext',
		array(
		    'label'   		=> __('Email Text','architecture-designer'),
		    'section'		=> 'top_header',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)  
	);		


	
	// topheader icon 2
	$topheadermobicon = esc_html__('fa fa-phone', 'architecture-designer' );
	$wp_customize->add_setting(
    	'topheader_mobicon',
    	array(
			'default' => $topheadermobicon,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 7,
		)
	);	

	$wp_customize->add_control( 
		'topheader_mobicon',
		array(
		    'label'   		=> __('Phone Icon','architecture-designer'),
		    'section'		=> 'top_header',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)  
	);	




	// topheader text 2
	$topheadermobtext = esc_html__('+91 800 9705 390', 'architecture-designer' );
	$wp_customize->add_setting(
    	'topheader_mobtext',
    	array(
			'default' => $topheadermobtext,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 8,
		)
	);	

	$wp_customize->add_control( 
		'topheader_mobtext',
		array(
		    'label'   		=> __('Phone Text','architecture-designer'),
		    'section'		=> 'top_header',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)  
	);	

	
	// header icon 1
	$headericon1 = esc_html__('fa fa-facebook', 'architecture-designer' );
	$wp_customize->add_setting(
    	'header_icon1',
    	array(
			'default' => $headericon1,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 9,
		)
	);	

	$wp_customize->add_control( 
		'header_icon1',
		array(
		    'label'   		=> __('Icon 1','architecture-designer'),
		    'section'		=> 'top_header',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)  
	);


	// icon 1 link
	$headericon1link = esc_html__('#', 'architecture-designer' );
	$wp_customize->add_setting(
    	'header_icon1link',
    	array(
			'default' => $headericon1link,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 10,
		)
	);	

	$wp_customize->add_control( 
		'header_icon1link',
		array(
		    'label'   		=> __('Icon 1 Link','architecture-designer'),
		    'section'		=> 'top_header',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)  
	);


	// header icon 2
	$headericon2 = esc_html__('fa fa-instagram', 'architecture-designer' );
	$wp_customize->add_setting(
    	'header_icon2',
    	array(
			'default' => $headericon2,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 11,
		)
	);	

	$wp_customize->add_control( 
		'header_icon2',
		array(
		    'label'   		=> __('Icon 2','architecture-designer'),
		    'section'		=> 'top_header',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)  
	);

	// header icon 2 link
	$headericon2link = esc_html__('#', 'architecture-designer' );
	$wp_customize->add_setting(
    	'header_icon2link',
    	array(
			'default' => $headericon2link,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 12,
		)
	);	

	$wp_customize->add_control( 
		'header_icon2link',
		array(
		    'label'   		=> __('Icon 2 Link','architecture-designer'),
		    'section'		=> 'top_header',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)  
	);

	// header icon 3
	$headericon3 = esc_html__('fa fa-twitter', 'architecture-designer' );
	$wp_customize->add_setting(
    	'header_icon3',
    	array(
			'default' => $headericon3,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 13,
		)
	);	

	$wp_customize->add_control( 
		'header_icon3',
		array(
		    'label'   		=> __('Icon 3','architecture-designer'),
		    'section'		=> 'top_header',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)  
	);	

	// header icon 3 link
	$headericon3link = esc_html__('#', 'architecture-designer' );
	$wp_customize->add_setting(
    	'header_icon3link',
    	array(
			'default' => $headericon3link,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 14,
		)
	);	

	$wp_customize->add_control( 
		'header_icon3link',
		array(
		    'label'   		=> __('Icon 3 Link','architecture-designer'),
		    'section'		=> 'top_header',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)  
	);


	// header icon 4
	$headericon4 = esc_html__('fa fa-linkedin', 'architecture-designer' );
	$wp_customize->add_setting(
    	'header_icon4',
    	array(
			'default' => $headericon4,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 15,
		)
	);	

	$wp_customize->add_control( 
		'header_icon4',
		array(
		    'label'   		=> __('Icon 4','architecture-designer'),
		    'section'		=> 'top_header',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)  
	);	

	// header icon 4 link
	$headericon4link = esc_html__('#', 'architecture-designer' );
	$wp_customize->add_setting(
    	'header_icon4link',
    	array(
			'default' => $headericon4link,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 16,
		)
	);	

	$wp_customize->add_control( 
		'header_icon4link',
		array(
		    'label'   		=> __('Icon 4 Link','architecture-designer'),
		    'section'		=> 'top_header',
			'type' 			=> 'text',
			'transport'         => $selective_refresh,
		)  
	);


	// style setting

	// top header bg color
	$topheaderbgcol = esc_html__('#0f332e', 'architecture-designer' );
	$wp_customize->add_setting(
    	'topheader_bgcol',
    	array(
			'default' => $topheaderbgcol,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 17,
		)
	);	

	$wp_customize->add_control( 
		'topheader_bgcol',
		array(
		    'label'   		=> __('Top BG Color','architecture-designer'),
		    'section'		=> 'top_header',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);


	// top header icon 
	$topheadericoncol = esc_html__('#fdfdfd', 'architecture-designer' );
	$wp_customize->add_setting(
    	'topheader_iconcol',
    	array(
			'default' => $topheadericoncol,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 17,
		)
	);	

	$wp_customize->add_control( 
		'topheader_iconcol',
		array(
		    'label'   		=> __('Top Icon Color','architecture-designer'),
		    'section'		=> 'top_header',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);

	// top header icon border color
	$topheadericonbordercol = esc_html__('#fdfdfd', 'architecture-designer' );
	$wp_customize->add_setting(
    	'topheader_iconbordercol',
    	array(
			'default' => $topheadericonbordercol,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 17,
		)
	);	

	$wp_customize->add_control( 
		'topheader_iconbordercol',
		array(
		    'label'   		=> __('Top Icon Border Color','architecture-designer'),
		    'section'		=> 'top_header',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);

	// top header text 
	$topheadercolortext = esc_html__('#9a9e9e', 'architecture-designer' );
	$wp_customize->add_setting(
    	'topheader_colortext',
    	array(
			'default' => $topheadercolortext,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 18,
		)
	);	

	$wp_customize->add_control( 
		'topheader_colortext',
		array(
		    'label'   		=> __('Top Text Color','architecture-designer'),
		    'section'		=> 'top_header',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);
	
	// header icon 
	$headericoncol = esc_html__('#15403c', 'architecture-designer' );
	$wp_customize->add_setting(
    	'header_iconcol',
    	array(
			'default' => $headericoncol,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 19,
		)
	);	

	$wp_customize->add_control( 
		'header_iconcol',
		array(
		    'label'   		=> __('Social Icon Color','architecture-designer'),
		    'section'		=> 'top_header',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);

	// header bg icon 
	$headerbgiconcol = esc_html__('#fdfdfd', 'architecture-designer' );
	$wp_customize->add_setting(
    	'header_bg_iconcol',
    	array(
			'default' => $headerbgiconcol,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 20,
		)
	);	

	$wp_customize->add_control( 
		'header_bg_iconcol',
		array(
		    'label'   		=> __('Social Icon BG Color','architecture-designer'),
		    'section'		=> 'top_header',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);


	// menu icon 
	$menucolor = esc_html__('#ffffff', 'architecture-designer' );
	$wp_customize->add_setting(
    	'menu_color',
    	array(
			'default' => $menucolor,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 20,
		)
	);	

	$wp_customize->add_control( 
		'menu_color',
		array(
		    'label'   		=> __('Menu Color','architecture-designer'),
		    'section'		=> 'top_header',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);

	// menu icon 
	$menuarrowcolor = esc_html__('#ffffff', 'architecture-designer' );
	$wp_customize->add_setting(
    	'menuarrow_color',
    	array(
			'default' => $menuarrowcolor,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 20,
		)
	);	

	$wp_customize->add_control( 
		'menuarrow_color',
		array(
		    'label'   		=> __('Menu Dropdown Arrow Color','architecture-designer'),
		    'section'		=> 'top_header',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);

	// menuhover icon 
	$menuhovercolor = esc_html__('#0f332e', 'architecture-designer' );
	$wp_customize->add_setting(
    	'menuhover_color',
    	array(
			'default' => $menuhovercolor,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 20,
		)
	);	

	$wp_customize->add_control( 
		'menuhover_color',
		array(
		    'label'   		=> __('Menu Hover Color','architecture-designer'),
		    'section'		=> 'top_header',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);


	// submenu text
	$submenutextcolor = esc_html__('#1f1f1f', 'architecture-designer' );
	$wp_customize->add_setting(
    	'submenutext_color',
    	array(
			'default' => $submenutextcolor,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 20,
		)
	);	

	$wp_customize->add_control( 
		'submenutext_color',
		array(
		    'label'   		=> __('SubMenu Text Color','architecture-designer'),
		    'section'		=> 'top_header',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);

	// submenubg  
	$submenubgcolor = esc_html__('#ffffff', 'architecture-designer' );
	$wp_customize->add_setting(
    	'submenubg_color',
    	array(
			'default' => $submenubgcolor,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 20,
		)
	);	

	$wp_customize->add_control( 
		'submenubg_color',
		array(
		    'label'   		=> __('SubMenu BG Color','architecture-designer'),
		    'section'		=> 'top_header',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);

	// submenutexthover  
	$submenutexthovercolor = esc_html__('#ffffff', 'architecture-designer' );
	$wp_customize->add_setting(
    	'submenutexthover_color',
    	array(
			'default' => $submenutexthovercolor,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 20,
		)
	);	

	$wp_customize->add_control( 
		'submenutexthover_color',
		array(
		    'label'   		=> __('SubMenu Text Hover Color','architecture-designer'),
		    'section'		=> 'top_header',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);


	// submenubghover  
	$submenubghovercolor = esc_html__('#0f332e', 'architecture-designer' );
	$wp_customize->add_setting(
    	'submenubghover_color',
    	array(
			'default' => $submenubghovercolor,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 20,
		)
	);	

	$wp_customize->add_control( 
		'submenubghover_color',
		array(
		    'label'   		=> __('SubMenu BG Hover Color','architecture-designer'),
		    'section'		=> 'top_header',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);


	// submenuborder  
	$submenubordercolor = esc_html__('#fff', 'architecture-designer' );
	$wp_customize->add_setting(
    	'submenuborder_color',
    	array(
			'default' => $submenubordercolor,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 20,
		)
	);	

	$wp_customize->add_control( 
		'submenuborder_color',
		array(
		    'label'   		=> __('SubMenu Border Color','architecture-designer'),
		    'section'		=> 'top_header',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);

	// menutoggle  
	$menutogglecolor = esc_html__('#000', 'architecture-designer' );
	$wp_customize->add_setting(
    	'menutoggle_color',
    	array(
			'default' => $menutogglecolor,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 20,
		)
	);	

	$wp_customize->add_control( 
		'menutoggle_color',
		array(
		    'label'   		=> __('Mobile Menu Toggle Color','architecture-designer'),
		    'section'		=> 'top_header',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);

	// mobielmenubg  
	$mobielmenubgcolor = esc_html__('#fff', 'architecture-designer' );
	$wp_customize->add_setting(
    	'mobielmenubg_color',
    	array(
			'default' => $mobielmenubgcolor,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 20,
		)
	);	

	$wp_customize->add_control( 
		'mobielmenubg_color',
		array(
		    'label'   		=> __('Mobile Menu BG Color','architecture-designer'),
		    'section'		=> 'top_header',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);

	// mobielmenuborder  
	$mobielmenubordercolor = esc_html__('#07332e', 'architecture-designer' );
	$wp_customize->add_setting(
    	'mobielmenuborder_color',
    	array(
			'default' => $mobielmenubordercolor,
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
			'priority'      => 20,
		)
	);	

	$wp_customize->add_control( 
		'mobielmenuborder_color',
		array(
		    'label'   		=> __('Mobile Menu Border Color','architecture-designer'),
		    'section'		=> 'top_header',
			'type' 			=> 'color',
			'transport'         => $selective_refresh,
		)  
	);


	// layout setting

	$wp_customize->add_setting('architecturedesigner_header_section_width',array(
        'default' => 'Box Width',
        'sanitize_callback' => 'architecturedesigner_sanitize_choices',
    ));
    $wp_customize->add_control('architecturedesigner_header_section_width',array(
        'type' => 'select',
        'label' => __('Header Width','architecture-designer'),
        'choices' => array (
            'Box Width' => __('Box Width','architecture-designer'),
            'Full Width' => __('Full Width','architecture-designer')
        ),
        'section' => 'top_header',
    ));



	/*=========================================
	Architecture Designer footer
	=========================================*/
	$wp_customize->add_section(
        'footer',
        array(
        	'priority'      => 6,
            'title' 		=> __('Fotter','architecture-designer'),
			'panel'  		=> 'header_section',
		)
    );	



	$wp_customize->register_control_type('architecturedesigner_Tab_Control');
	$wp_customize->register_panel_type( 'architecturedesigner_WP_Customize_Panel' );
	$wp_customize->register_section_type( 'architecturedesigner_WP_Customize_Section' );

	

}
add_action( 'customize_register', 'architecturedesigner_header_settings' );



if ( class_exists( 'WP_Customize_Panel' ) ) {
  	class architecturedesigner_WP_Customize_Panel extends WP_Customize_Panel {
	   public $panel;
	   public $type = 'architecturedesigner_panel';
	   public function json() {

	      $array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'type', 'panel', ) );
	      $array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
	      $array['content'] = $this->get_content();
	      $array['active'] = $this->active();
	      $array['instanceNumber'] = $this->instance_number;
	      return $array;
    	}
  	}
}

if ( class_exists( 'WP_Customize_Section' ) ) {
  	class architecturedesigner_WP_Customize_Section extends WP_Customize_Section {
	   public $section;
	   public $type = 'architecturedesigner_section';
	   public function json() {

	      $array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'panel', 'type', 'description_hidden', 'section', ) );
	      $array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
	      $array['content'] = $this->get_content();
	      $array['active'] = $this->active();
	      $array['instanceNumber'] = $this->instance_number;

	      if ( $this->panel ) {
	        $array['customizeAction'] = sprintf( 'Customizing &#9656; %s', esc_html( $this->manager->get_panel( $this->panel )->title ) );
	      } else {
	        $array['customizeAction'] = 'Customizing';
	      }
	      return $array;
    	}
  	}
}






