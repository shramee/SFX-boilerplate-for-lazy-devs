<?php
/**
 * Created by PhpStorm.
 * User: shramee
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
	 * Enqueue CSS and custom styles.
	 * @since   1.0.0
	 * @return  void
	 */
	public function styles() {
		wp_enqueue_style( 'seb-styles', plugins_url( '/assets/css/style.css', __FILE__ ) );

		$heading_background_color 	= storefront_sanitize_hex_color( get_theme_mod( 'color_picker', apply_filters( 'default_heading_background_color', '#ff0000' ) ) );

		$style = '
		h1,
		h2,
		h3,
		h4,
		h5,
		h6 {
			background-color: ' . $heading_background_color . ';
		}';

		wp_add_inline_style( 'seb-styles', $style );
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
		$checkbox 	= get_theme_mod( 'checkbox', apply_filters( 'checkbox_default', false ) );

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