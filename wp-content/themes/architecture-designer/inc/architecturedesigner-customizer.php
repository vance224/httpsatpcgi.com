<?php
/**
 * Architecture Designer Theme Customizer.
 *
 * @package Architecture Designer
 */

 if ( ! class_exists( 'architecturedesigner_Customizer' ) ) {

	/**
	 * Customizer Loader
	 *
	 * @since 1.0.0
	 */
	class architecturedesigner_Customizer {

		/**
		 * Instance
		 *
		 * @access private
		 * @var object
		 */
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self;
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
			/**
			 * Customizer
			 */
			add_action( 'customize_preview_init',                  array( $this, 'architecturedesigner_customize_preview_js' ) );
			add_action( 'customize_controls_enqueue_scripts', 	   array( $this, 'architecturedesigner_customizer_script' ) );
			add_action( 'customize_register',                      array( $this, 'architecturedesigner_customizer_register' ) );
			add_action( 'after_setup_theme',                       array( $this, 'architecturedesigner_customizer_settings' ) );
		}
		
		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
		 */
		function architecturedesigner_customizer_register( $wp_customize ) {
			
			$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
			$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
			$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
			$wp_customize->get_setting('custom_logo')->transport = 'refresh';			
			
			/**
			 * Helper files
			 */
			require ARCHITECTUREDESIGNER_PARENT_INC_DIR . '/customizer/sanitization.php';
		}


	
		
		/**
		 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
		 */
		function architecturedesigner_customize_preview_js() {
			wp_enqueue_script( 'architecturedesigner-customizer', ARCHITECTUREDESIGNER_PARENT_INC_URI . '/customizer/assets/js/customizer-preview.js', array( 'customize-preview' ), '20151215', true );
		}
		
		
		function architecturedesigner_customizer_script() {
			 wp_enqueue_script( 'architecturedesigner-customizer-section', ARCHITECTUREDESIGNER_PARENT_INC_URI .'/customizer/assets/js/customizer-section.js', array("jquery"),'', true  );	
		}

		// Include customizer customizer settings.
			
		function architecturedesigner_customizer_settings() {	
			   require ARCHITECTUREDESIGNER_PARENT_INC_DIR . '/customizer/customizer-options/architecturedesigner-allsettings.php';
			   require ARCHITECTUREDESIGNER_PARENT_INC_DIR . '/customizer/customizer-options/architecturedesigner-frontpage.php';
			   // require ARCHITECTUREDESIGNER_PARENT_INC_DIR . '/customizer/customizer-options/architecturedesigner-general.php';
			   require ARCHITECTUREDESIGNER_PARENT_INC_DIR . '/customizer/customizer-options/architecturedesigner-footer.php';
			   require ARCHITECTUREDESIGNER_PARENT_INC_DIR . '/customizer/customizer-options/architecturedesigner-innerpage.php';
			   require ARCHITECTUREDESIGNER_PARENT_INC_DIR . '/customizer/customizer-options/architecturedesigner_customizer_import_data.php';
			   require ARCHITECTUREDESIGNER_PARENT_INC_DIR . '/customizer/customizer-pro/class-customize.php';
		}

	}
}// End if().

/**
 *  Kicking this off by calling 'get_instance()' method
 */
architecturedesigner_Customizer::get_instance();