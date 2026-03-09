<?php
/**
 * Customizer section options.
 *
 * @package interior-startup
 *
 */

function interior_startup_customizer_theme_settings( $wp_customize ){
	
	$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';	
		
		$wp_customize->add_setting(
			'arilewp_footer_copright_text',
			array(
				'sanitize_callback' =>  'interior_startup_sanitize_text',
				'default' => __('Copyright &copy; 2023 | Powered by <a href="//wordpress.org/">WordPress</a> <span class="sep"> | </span> Interior Startup theme by <a target="_blank" href="//themearile.com/">ThemeArile</a>', 'interior-startup'),
				'transport'         => $selective_refresh,
			)	
		);
		$wp_customize->add_control('arilewp_footer_copright_text', array(
				'label' => esc_html__('Footer Copyright','interior-startup'),
				'section' => 'arilewp_footer_copyright',
				'priority'        => 10,
				'type'    =>  'textarea'
		));

}
add_action( 'customize_register', 'interior_startup_customizer_theme_settings' );

function interior_startup_sanitize_text( $input ) {
		return wp_kses_post( force_balance_tags( $input ) );
}