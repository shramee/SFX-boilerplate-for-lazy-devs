<?php
/**
 * Created by PhpStorm.
 * User: Shramee Srivastav <shramee.srivastav@gmail.com>
 * Date: 27/4/15
 * Time: 5:36 PM
 */


/**
 * Storefront_Extension_Boilerplate_Public Class
 *
 * @class Storefront_Extension_Boilerplate_Public
 * @version	1.0.0
 * @since 1.0.0
 * @package	Storefront_Extension_Boilerplate
 */
final class Storefront_Extension_Boilerplate_Public extends Storefront_Extension_Boilerplate_Abstract {

	private $phone_menu_items = array();

	/**
	 * Called by parent::__construct
	 * Do initialization here
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function init(){

		//Enqueue scripts and styles
		add_action( 'wp_enqueue_scripts', array( $this, 'styles' ), 999 );
		//Add plugin classes to body
		add_filter( 'body_class', array( $this, 'body_class' ) );

		//Sample : Adjusts the layout
		add_action( 'wp', array( $this, 'layout_adjustments' ), 999 );

	}

	/**
	 * Gets the theme mod for customizer fields
	 *
	 * @param string $id
	 * @param string $default
	 * @return string Setting value
	 */
	public function get_theme_mod( $id, $default = null ){
		return get_theme_mod( $this->token . '-' . preg_replace( "/[^\w]+/",  '-', strtolower( $id ) ), $default );
	}

	/**
	 * Enqueue CSS and custom styles.
	 * @since   1.0.0
	 * @return  void
	 */
	public function styles() {
		wp_enqueue_style( 'seb-styles', $this->plugin_url . '/assets/css/style.css' );

		//Add custom css here
		$css = '';

		wp_add_inline_style( 'seb-styles', $css );
	}

	/**
	 * Storefront Extension Boilerplate Body Class
	 * Adds a class based on the extension name and any relevant settings.
	 */
	public function body_class( $classes ) {
		$classes[] = 'storefront-extension-boilerplate-active';

		return $classes;
	}

	/**
	 * Sample
	 * Adjusts the default Storefront layout when the plugin is active
	 */
	public function layout_adjustments() {
		$checkbox 	= get_theme_mod( 'seb_checkbox', apply_filters( 'checkbox_default', false ) );

		if ( true == $checkbox ) {
			add_action( 'storefront_header', array( $this, 'primary_navigation_wrapper' ), 45 );
			add_action( 'storefront_header', array( $this, 'primary_navigation_wrapper_close' ), 65 );
		}
	}

	/**
	 * Sample
	 * Primary navigation wrapper
	 * @return void
	 */
	function primary_navigation_wrapper() {
		echo '<section class="seb-primary-navigation">';
	}

	/**
	 * Sample
	 * Primary navigation wrapper close
	 * @return void
	 */
	function primary_navigation_wrapper_close() {
		echo '</section>';
	}
} // End class