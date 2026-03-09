<?php
class architecturedesigner_import_dummy_data {

	private static $instance;

	public static function init( ) {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof architecturedesigner_import_dummy_data ) ) {
			self::$instance = new architecturedesigner_import_dummy_data;
			self::$instance->architecturedesigner_setup_actions();
		}

	}

	/**
	 * Setup the class props based on the config array.
	 */
	

	/**
	 * Setup the actions used for this class.
	 */
	public function architecturedesigner_setup_actions() {

		// Enqueue scripts
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'architecturedesigner_import_customize_scripts' ), 0 );

	}
	
	

	public function architecturedesigner_import_customize_scripts() {

	wp_enqueue_script( 'architecturedesigner-import-customizer-js', ARCHITECTUREDESIGNER_PARENT_INC_URI . '/customizer/customizer-notify/js/architecturedesigner-import-customizer-options.js', array( 'customize-controls' ) );
	}
}

$architecturedesigner_import_customizers = array(

		'import_data' => array(
			'recommended' => true,
			
		),
);
architecturedesigner_import_dummy_data::init( apply_filters( 'architecturedesigner_import_customizer', $architecturedesigner_import_customizers ) );