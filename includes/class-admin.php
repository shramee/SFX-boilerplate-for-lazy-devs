<?php
/**
 * Created by PhpStorm.
 * User: Shramee Srivastav <shramee.srivastav@gmail.com>
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
	 * The customizer control render object.
	 * @var     object
	 * @access  public
	 * @since   1.0.0
	 */
	public $customizer;

	/**
	 * Called by parent::__construct
	 * Do initialization here
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function init(){

		//Customizer fields renderer
		$this->customizer = new Storefront_Extension_Boilerplate_Customizer_Fields( $this->token, $this->plugin_path, $this->plugin_url );
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
		global $storefront_extension_boilerplate_customizer_fields;

		foreach ( $storefront_extension_boilerplate_customizer_fields as $f ) {
			$sections[ $f['section'] ][] = $f;
		}

		$this->customizer->customizer_fields( $wp_customize, $sections );

	}

	/**
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 *
	 * @since  1.0.0
	 */
	public function seb_customize_preview_js() {
		wp_enqueue_script( 'seb-customizer', $this->plugin_url . '/assets/js/customizer.min.js', array( 'customize-preview' ), '1.1', true );
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