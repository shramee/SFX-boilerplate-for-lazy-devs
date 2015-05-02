<?php
/**
 * Created by PhpStorm.
 * User: shramee
 * Date: 27/4/15
 * Time: 5:36 PM
 */


/**
 * Storefront_Extension_Boilerplate_Admin Class
 *
 * @class Storefront_Extension_Boilerplate_Admin
 * @version	1.0.0
 * @since 1.0.0
 * @package	Storefront_Extension_Boilerplate
 */
final class Storefront_Extension_Boilerplate_Admin extends Storefront_Extension_Boilerplate_Abstract {

	/**
	 * Called by parent::__construct
	 * Do initialization here
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function init(){

		//Customize register
		add_action( 'customize_register', array( $this, 'seb_customize_register' ) );
		//Customize preview init script
		add_action( 'customize_preview_init', array( $this, 'seb_customize_preview_js' ) );
		//Admin notices
		add_action( 'admin_notices', array( $this, 'seb_customizer_notice' ) );
	}

	/**
	 * Customizer Controls and settings
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function seb_customize_register( $wp_customize ) {

		/**
		 * Custom controls
		 * Load custom control classes
		 */
		require_once 'class-images-control.php';

		/**
		 * Modify existing controls
		 */
		// Note: If you want to modiy existing controls, do it this way. You can set defaults, change the transport, etc.
		//$wp_customize->get_setting( 'storefront_header_background_color' )->transport = 'refresh';

		/**
	     * Add a new section
	     */
        $wp_customize->add_section( 'seb_section' , array(
		    'title'      	=> __( 'Storefront Extension Boilerplate', 'storefront-extention-boilerplate' ),
		    'description' 	=> __( 'Add a description, if you want to!', 'storefront-extention-boilerplate' ),
		    'priority'   	=> 55,
		) );

		/**
		 * Sample
		 * Image selector radios
		 * See class-control-images.php
		 */
		$wp_customize->add_setting( 'seb_image', array(
			'default'    		=> 'option-1',
			'sanitize_callback'	=> 'esc_attr'
		) );

		$wp_customize->add_control( new Storefront_Extension_Boilerplate_Images_Control( $wp_customize, 'seb_image', array(
			'label'    => __( 'Image selector', 'storefront' ),
			'section'  => 'seb_section',
			'settings' => 'seb_image',
			'priority' => 10,
		) ) );

		/**
		 * Sample Divider.
		 * Type can be set to 'text' or 'heading' to display a title or description.
		 */
		if ( class_exists( 'Arbitrary_Storefront_Control' ) ) {
			$wp_customize->add_control( new Arbitrary_Storefront_Control( $wp_customize, 'seb_divider', array(
				'section'  	=> 'seb_section',
				'type'		=> 'divider',
				'priority' 	=> 15,
			) ) );
		}

		/**
		 * Sample Checkbox
		 */
		$wp_customize->add_setting( 'seb_checkbox', array(
			'default'			=> apply_filters( 'seb_checkbox_default', false ),
			'sanitize_callback'	=> 'absint',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seb_checkbox', array(
			'label'			=> __( 'Checkbox', 'storefront-extension-boilerplate' ),
			'description'	=> __( 'Here\'s a simple boolean checkbox option. In this instance it toggles wrapping the main navigation in a wrapper div.', 'storefront-extension-boilerplate' ),
			'section'		=> 'seb_section',
			'settings'		=> 'seb_checkbox',
			'type'			=> 'checkbox',
			'priority'		=> 20,
		) ) );

		/**
		 * Sample Color picker
		 */
		$wp_customize->add_setting( 'seb_color_picker', array(
			'default'			=> apply_filters( 'seb_color_picker_default', '#ff0000' ),
			'sanitize_callback'	=> 'sanitize_hex_color',
			'transport'			=> 'postMessage', // Refreshes instantly via js. See customizer.js. (default = refresh).
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'seb_color_picker', array(
			'label'			=> __( 'Color picker', 'storefront-extension-boilerplate' ),
			'description'	=> __( 'Here\'s an example color picker. In this instance it applies a background color to headings', 'storefront-extension-boilerplate' ),
			'section'		=> 'seb_section',
			'settings'		=> 'seb_color_picker',
			'priority'		=> 30,
		) ) );

		/**
		 * Sample Select
		 */
		$wp_customize->add_setting( 'seb_select', array(
			'default' 			=> 'default',
			'sanitize_callback'	=> 'storefront_sanitize_choices',
		) );

		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'seb_select', array(
			'label'			=> __( 'Select', 'storefront-extension-boilerplate' ),
			'description'	=> __( 'Make a selection!', 'storefront-extension-boilerplate' ),
			'section'		=> 'seb_section',
			'settings'		=> 'seb_select',
			'type'			=> 'select', // To add a radio control, switch this to 'radio'.
			'priority'		=> 40,
			'choices'		=> array(
				'default'		=> 'Default',
				'non-default'	=> 'Non-default',
			),
		) ) );
	}

	/**
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 *
	 * @since  1.0.0
	 */
	public function seb_customize_preview_js() {
		wp_enqueue_script( 'seb-customizer', plugins_url( '/assets/js/customizer.min.js', __FILE__ ), array( 'customize-preview' ), '1.1', true );
	}

	/**
	 * Admin notice
	 * Checks the notice setup in install(). If it exists display it then delete the option so it's not displayed again.
	 * @since   1.0.0
	 * @return  void
	 */
	public function seb_customizer_notice() {
		$notices = get_option( 'seb_activation_notice' );

		if ( $notices = get_option( 'seb_activation_notice' ) ) {

			foreach ( $notices as $notice ) {
				echo '<div class="notice is-dismissible updated">' . $notice . '</div>';
			}

			delete_option( 'seb_activation_notice' );
		}
	}

} // End class