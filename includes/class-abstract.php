<?php
/**
 * Created by PhpStorm.
 * User: Shramee Srivastav <shramee.srivastav@gmail.com>
 * Date: 27/4/15
 * Time: 5:36 PM
 */

/**
 * Storefront_Extension_Boilerplate_Abstract
 * All classes except main extend this
 *
 * @class Storefront_Extension_Boilerplate_Abstract
 * @version	1.0.0
 * @since 1.0.0
 * @package	Storefront_Extension_Boilerplate
 */
abstract class Storefront_Extension_Boilerplate_Abstract {

	/**
	 * The token.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $token;
	
	/*
	 * The plugin directory url.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $plugin_url;

	/*
	 * The plugin directory url.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $plugin_path;

	/**
	 * Constructor function.
	 *
	 * @param string $token
	 * @param string $url
	 * @param string $path
	 *
	 * @access  public
	 * @since   1.0.0
	 */
	public function __construct( $token, $path, $url ) {

		$this->token 			= $token;
		$this->plugin_path 		= $path;
		$this->plugin_url 		= $url;

		if ( method_exists( $this, 'init' ) ) {
			$this->init( func_get_args() );
		}
	}

	/**
	 * Hook for descendant class
	 * @return void
	 */
	public function init(){
		//For descendants
	}

} // End class