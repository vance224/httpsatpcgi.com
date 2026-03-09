<?php
function architecturedesigner_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'architecturedesigner_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '646464',
		'width'                  => 2000, 
		'height'                 => 200,
		'flex-height'            => true,
		'wp-head-callback'       => 'architecturedesigner_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'architecturedesigner_custom_header_setup' );

if ( ! function_exists( 'architecturedesigner_header_style' ) ) :

function architecturedesigner_header_style() {
	$header_text_color = get_header_textcolor();


	$topheader_sitetitlecol = get_theme_mod('topheader_sitetitlecol','#646464');
	$topheader_taglinecol = get_theme_mod('topheader_taglinecol','#9a9e9e');
	$topheader_boxbgcol = get_theme_mod('topheader_boxbgcol','#fff');


	$topheader_logowidth = get_theme_mod('topheader_logowidth','100');
	$topheader_bgcol = get_theme_mod('topheader_bgcol','#ffffff');
  	$slider_text_color = get_theme_mod('slider_text_color','#fff');
	$header_menufontsize = get_theme_mod('header_menufontsize','16');

  	$menuarrow_color = get_theme_mod('menuarrow_color','#ffffff');
  	$menu_color = get_theme_mod('menu_color','#ffffff');
  	$menuhover_color = get_theme_mod('menuhover_color','#0f332e');
  	$submenutext_color = get_theme_mod('submenutext_color','#1f1f1f');
  	$submenubg_color = get_theme_mod('submenubg_color','#ffffff');
  	$submenutexthover_color = get_theme_mod('submenutexthover_color','#ffffff');
  	$submenubghover_color = get_theme_mod('submenubghover_color','#0f332e');
  	$submenuborder_color = get_theme_mod('submenuborder_color','#fff');
  	$menutoggle_color = get_theme_mod('menutoggle_color','#000');
  	$mobielmenubg_color = get_theme_mod('mobielmenubg_color','#fff');
  	$mobielmenuborder_color = get_theme_mod('mobielmenuborder_color','#07332e');



	$service_text_col = get_theme_mod('service_text_col','#a1a1a1');
	$blog_btn_text_col = get_theme_mod('blog_btn_text_col','#fff');
	$blog_btn_col = get_theme_mod('blog_btn_col','#06332e');
	$blog_btn_hrv_bor_col = get_theme_mod('blog_btn_hrv_bor_col','#fff');

	$blog_title_col = get_theme_mod('blog_title_col','#000');
	$blog_text_col = get_theme_mod('blog_text_col','#b4b6b5');
	$blog_adminandcommtxt_col = get_theme_mod('blog_adminandcommtxt_col','#06332e');
	$blog_adminandcommicon_col = get_theme_mod('blog_adminandcommicon_col','#07332e');
	$blog_date_col = get_theme_mod('blog_date_col','#07332e');
	$blog_date_bg_col = get_theme_mod('blog_date_bg_col','#eae4e4');
	$blog_box_border_color = get_theme_mod('blog_box_border_color','#b4b5b0');


  	$slider_section_show_content = get_theme_mod('slider_section_show_content','YES');

  	$slider_boxborder_color = get_theme_mod('slider_boxborder_color','#fff');

  	$service_show_content = get_theme_mod('service_show_content','YES');
  	$blog_show_content = get_theme_mod('blog_show_content','YES');


  	$architecturedesigner_service_top_padding = get_theme_mod('architecturedesigner_service_top_padding','5');
  	$architecturedesigner_service_bottom_padding = get_theme_mod('architecturedesigner_service_bottom_padding','4');

  	$architecturedesigner_services_post_img_height = get_theme_mod('architecturedesigner_services_post_img_height','380');



  	$architecturedesigner_blog_section_t_padding = get_theme_mod('architecturedesigner_blog_section_t_padding','5');
  	$architecturedesigner_blog_section_b_padding = get_theme_mod('architecturedesigner_blog_section_b_padding','4');

  	$architecturedesigner_blog_post_img_height = get_theme_mod('architecturedesigner_blog_post_img_height','225');

  	$footer_bg = get_theme_mod('footer_bg','#07332e');

  	$slider_btn_hrv_color = get_theme_mod('slider_btn_hrv_color','#07332e');
  	$slider_btn_hrv_txt_color = get_theme_mod('slider_btn_hrv_txt_color','#fff');
  	$slider_btn_hrv_bor_color = get_theme_mod('slider_btn_hrv_bor_color','#07332e');
  	$service_box_border = get_theme_mod('service_box_border','#ccc');


  	// footer
  	$footer_icon_color = get_theme_mod('footer_icon_color','#fff');
  	$footer_list_color = get_theme_mod('footer_list_color','#ebeeec');
  	$footer_list_hover_color = get_theme_mod('footer_list_hover_color','#8a8a8a');
  	$footer_Heading_color = get_theme_mod('footer_Heading_color','#fff');
  	$footer_text_color = get_theme_mod('footer_text_color','#fff');

  	$footer_bottombg_color = get_theme_mod('footer_bottombg_color','#020202');
  	$footer_bottomtext_color = get_theme_mod('footer_bottomtext_color','#fff');
  	$footer_bottomlink_color = get_theme_mod('footer_bottomlink_color','#07332e');
  	$footer_scrolltoparrow_color = get_theme_mod('footer_scrolltoparrow_color','#fff');
  	$footer_scrolltopbg_color = get_theme_mod('footer_scrolltopbg_color','#0f332e');
  	$footer_scrolltopbghover_color = get_theme_mod('footer_scrolltopbghover_color','#0f332e');


	?>
	<style type="text/css">

		<?php 
		
		?>


		.footer-area .footer-widget .widget:not(.widget_social_widget):not(.widget_tag_cloud) li:before {
			color: <?php echo apply_filters('architecturedesigner_footer', $footer_icon_color); ?>;
		}

		h4.site-title {
			color: <?php echo apply_filters('architecturedesigner_topheader', $topheader_sitetitlecol); ?> !important;
		}

		.main-header .upper-header-area .contact-box p {
			color: <?php echo apply_filters('architecturedesigner_topheader', $topheader_taglinecol); ?>;
		}

		.logo {
			background: <?php echo apply_filters('architecturedesigner_topheader', $topheader_boxbgcol); ?>;
		}

		.custom-logo {
			width: <?php echo apply_filters('architecturedesigner_topheader', $topheader_logowidth); ?>%;
			height: 70%;
		}

		.navigation .mainmenu li a {
			color: <?php echo apply_filters('architecturedesigner_topheader', $menu_color); ?>;
		}

		.navigation .mainmenu>li.menu-item-has-children>a:after {
			color: <?php echo apply_filters('architecturedesigner_topheader', $menuarrow_color); ?> !important;
		}

		.navigation .mainmenu li a:hover {
			color: <?php echo apply_filters('architecturedesigner_topheader', $menuhover_color); ?> !important;
		}



		.navigation .mainmenu ul.sub-menu li a {
			color: <?php echo apply_filters('architecturedesigner_topheader', $submenutext_color); ?> !important;
		}

		ul.sub-menu {
			background: <?php echo apply_filters('architecturedesigner_topheader', $submenubg_color); ?>;
		}

		.navigation .mainmenu ul.sub-menu li a:hover {
			color: <?php echo apply_filters('architecturedesigner_topheader', $submenutexthover_color); ?> !important;
		}

		.navigation .mainmenu ul.sub-menu li a:hover {
			background: <?php echo apply_filters('architecturedesigner_topheader', $submenubghover_color); ?>;
		}

		ul.sub-menu {
			outline-color: <?php echo apply_filters('architecturedesigner_topheader', $submenuborder_color); ?>;

		}

		.hamburger-menus span{
			background-color: <?php echo apply_filters('architecturedesigner_topheader', $menutoggle_color); ?> !important;
		}


		@media only screen and (max-width: 992px) {
			.navigation{
				background: <?php echo apply_filters('architecturedesigner_topheader', $mobielmenubg_color); ?> !important;
			}

			.navigation{
				border-right-color: <?php echo apply_filters('architecturedesigner_topheader', $mobielmenuborder_color); ?> !important;
			}
		}



		.navigation .mainmenu li a {
			font-size: <?php echo apply_filters('architecturedesigner_topheader', $header_menufontsize); ?>px;
		}

		.main-header {
			background: <?php echo apply_filters('architecturedesigner_topheader', $topheader_bgcol); ?>;
		}

		.main-header.header-fixed {
			background: <?php echo apply_filters('architecturedesigner_topheader', $topheader_bgcol); ?>;
		}

		.hero-style .slide-text p {
			color: <?php echo apply_filters('architecturedesigner_slider', $slider_text_color); ?>;
		}

		#service-section .single-service p {
			color: <?php echo apply_filters('architecturedesigner_blog', $service_text_col); ?>;
		}

		.blog-content .btn-blog {
			color: <?php echo apply_filters('architecturedesigner_blog', $blog_btn_text_col); ?> !important;
			background: <?php echo apply_filters('architecturedesigner_blog', $blog_btn_col); ?>;
		}

		.blog-content .btn-blog:before, .blog-content .btn-blog:after {
			border-color: <?php echo apply_filters('architecturedesigner_blog', $blog_btn_hrv_bor_col); ?> !important;
		}

	
		.blog-item .blog-content h6.post-title a {
			color: <?php echo apply_filters('architecturedesigner_blog', $blog_title_col); ?> !important;
		}

		.blog-content p {
			color: <?php echo apply_filters('architecturedesigner_blog', $blog_text_col); ?>;
		}

		.blog-item .theme-button {
			color: <?php echo apply_filters('architecturedesigner_blog', $blog_date_col); ?>;
		}

		.blog-item {
			border-color: <?php echo apply_filters('architecturedesigner_blog', $blog_box_border_color); ?>;
		}

		.blog-item .theme-button {
			background: <?php echo apply_filters('architecturedesigner_blog', $blog_date_bg_col); ?>;
		}

		.blog-item .comment-timing li a i {
			color: <?php echo apply_filters('architecturedesigner_blog', $blog_adminandcommicon_col); ?>;
		}

		.blog-item .comment-timing li a {
			color: <?php echo apply_filters('architecturedesigner_blog', $blog_adminandcommtxt_col); ?> !important;
		}

		#slider-section .slider-inner-box:before, #slider-section .slider-inner-box:after {
			border-color: <?php echo apply_filters('architecturedesigner_slider', $slider_boxborder_color); ?>;
		}


		#service-section {
			padding-top: <?php echo apply_filters('architecturedesigner_service', $architecturedesigner_service_top_padding); ?>em;
		}

		#service-section {
			padding-bottom: <?php echo apply_filters('architecturedesigner_service', $architecturedesigner_service_bottom_padding); ?>em;
		}

		#service-section .single-service .image {
			height: <?php echo apply_filters('architecturedesigner_service', $architecturedesigner_services_post_img_height); ?>px;
		}



		#blog-section {
			padding-top: <?php echo apply_filters('architecturedesigner_blog', $architecturedesigner_blog_section_t_padding); ?>em;
		}

		#blog-section {
			padding-bottom: <?php echo apply_filters('architecturedesigner_blog', $architecturedesigner_blog_section_b_padding); ?>em;
		}

		.blog-image {
			height: <?php echo apply_filters('architecturedesigner_blog', $architecturedesigner_blog_post_img_height); ?>px;
		}


		.footer-area .footer-top {
			background: <?php echo apply_filters('architecturedesigner_footer', $footer_bg); ?>;
		}
		



		.hero-style a.ReadMore:hover {
			background: <?php echo apply_filters('architecturedesigner_slider', $slider_btn_hrv_color); ?> !important;
		}

		.hero-style a.ReadMore:hover {
			color: <?php echo apply_filters('architecturedesigner_slider', $slider_btn_hrv_txt_color); ?> !important;
		}

		.hero-style a.ReadMore:before, .hero-style a.ReadMore:after {
			border-color: <?php echo apply_filters('architecturedesigner_slider', $slider_btn_hrv_bor_color); ?>;
		}

		#service-section .single-service .image:after {
			border-color: <?php echo apply_filters('architecturedesigner_service', $service_box_border); ?>;
		}


		
		
		.footer-area .footer-widget .widget:not(.widget_social_widget):not(.widget_tag_cloud) li a {
			color: <?php echo apply_filters('architecturedesigner_footer', $footer_list_color); ?>;
		}


		.footer-area .footer-widget .widget:not(.widget_social_widget):not(.widget_tag_cloud) li a:hover {
			color: <?php echo apply_filters('architecturedesigner_footer', $footer_list_hover_color); ?>; 
		}

		.footer-area .widget_block h1, .footer-area .widget_block h2, .footer-area .widget_block h3, .footer-area .widget_block h4, .footer-area .widget_block h5, .footer-area .widget_block h6 {
			color: <?php echo apply_filters('architecturedesigner_footer', $footer_Heading_color); ?>; 
		}

		.footer-area .widget_text, .footer-area .widget_text p, .wp-block-latest-comments__comment-excerpt p, .wp-block-latest-comments__comment-date, .has-avatars .wp-block-latest-comments__comment .wp-block-latest-comments__comment-excerpt, .has-avatars .wp-block-latest-comments__comment .wp-block-latest-comments__comment-meta {
			color: <?php echo apply_filters('architecturedesigner_footer', $footer_text_color); ?>; 
		}


		.copy-right {
			background: <?php echo apply_filters('architecturedesigner_footer', $footer_bottombg_color); ?>; 
		}

		.copy-right p {
			color: <?php echo apply_filters('architecturedesigner_footer', $footer_bottomtext_color); ?>; 
		}

		.copy-right p a {
			color: <?php echo apply_filters('architecturedesigner_footer', $footer_bottomlink_color); ?>; 
		}

		.scroll-top {
			color: <?php echo apply_filters('architecturedesigner_footer', $footer_scrolltoparrow_color); ?>; 
		}

		.scroll-top {
			background: <?php echo apply_filters('architecturedesigner_footer', $footer_scrolltopbg_color); ?>; 
		}

		.scroll-top:hover {
			background: <?php echo apply_filters('architecturedesigner_footer', $footer_scrolltopbghover_color); ?>; 
		}


		/* innerpages */

		.breadcrumb-list li a,.about-banner-text h1,.breadcrumb-list li {
			color: <?php echo esc_attr(get_theme_mod('innerpage_heading')); ?> !important;
		}



		<?php  ?>


	<?php
        if ($slider_section_show_content == 1):
	?>
		.slider-inner-box {
			display: none;
		}
	<?php
		else :
	?>
		.slider-inner-box {
			display: block;
		}
	<?php endif; ?>


	<?php
        if ($service_show_content == 1):
	?>
		#service-section {
			display: none;
		}
	<?php
		else :
	?>
		#service-section {
			display: block;
		}
	<?php endif; ?>


	<?php
        if ($blog_show_content == 1):
	?>
		.blog-area {
			display: none;
		}
	<?php
		else :
	?>
		.blog-area {
			display: block;
		}
	<?php endif; ?>



	<?php
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		else :
	?>
		h4.site-title{
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif;
