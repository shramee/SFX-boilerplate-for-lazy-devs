<?php
/**
 * Admin fields output class.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Cover_Pages
 * @subpackage Cover_Pages/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @class Cover_Pages_Customizer_Fields
 * @package    Cover_Pages
 * @subpackage Cover_Pages/admin
 * @author     Your Name <email@example.com>
 */
final class Storefront_Extension_Boilerplate_Customizer_Fields extends Storefront_Extension_Boilerplate_Abstract {
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 *
	 * @param    string $plugin_name The name of this plugin.
	 * @param    string $version The version of this plugin.
	 */
	public function init() {

	}

	/**
	 * Section id from name
	 *
	 * @param string $sec Section Name
	 * @return string Section ID
	 */
	public function get_sec_id( $sec ){
		return $this->token . '-section-' . preg_replace("/[^\w]+/", '-', strtolower( $sec ) );
	}

	/**
	 * Field id from name
	 *
	 * @param string $n Field Name
	 * @return string Field ID
	 */
	public function get_field_id( $n ){
		return $this->token . '-' . preg_replace("/[^\w]+/",  '-', strtolower( $n ) );
	}

	/**
	 * Customizer Controls and settings
	 * @param object WP_Customize_Manager $wp_customize Theme Customizer object.
	 * @global array $storefront_extension_boilerplate_customizer_fields
	 */
	public function seb_customize_register( $wp_customize ) {
		global $storefront_extension_boilerplate_customizer_fields;

		foreach ( $storefront_extension_boilerplate_customizer_fields as $f ) {
			$sections[ $f['section'] ][] = $f;
		}

		$this->customizer_fields( $wp_customize, $sections );

	}

	/**
	 * Sets the fields for the customizer
	 *
	 * @since	1.0.0
	 * @param object $wp_customize WP_Customizer
	 * @param array $sections Sections and their fields
	 */
	public function customizer_fields( $wp_customize, $sections ){

		foreach ( $sections as $Sec => $fields ) {


			if ( false === strstr( $Sec, 'existing_' ) ) {
				$sec = $this->get_sec_id( $Sec );

				$wp_customize->add_section(
					$sec,
					array(
						'title'    => $Sec,
						'priority' => 999,
					)
				);
			} else {
				$sec = str_replace( 'default_', '', $Sec );
			}

			foreach ( $fields as $f ){

				$id = $this->get_field_id( $f['id'] );

				//Arguments to pass to field
				$args = array(
					'section'  => $sec,
					'settings' => $id,
				);

				//Set label if not empty
				$args['label'] = empty( $f['label'] ) ? '' : esc_html__( $f['label'] );

				//Setting description if set
				if ( !empty( $f['description'] ) ) {
					$args['description'] = esc_html__( $f['description'] );
				}

				$args = wp_parse_args( $args, $f );

				//Setting a default
				$default = '';
				if ( isset( $f['default'] ) ) {
					$default = $f['default'];
				}

				//Add Setting
				$wp_customize->add_setting(
					$id,
					array(
						'default'   => $default,
						'transport' => 'refresh',
					)
				);

				$this->render_customizer_field( $wp_customize, $f, $id, $args );
			}
		}
	}

	/**
	 * Renders the fields for the cusmtomizer
	 *
	 * @since    1.0.0
	 *
	 * @param object $wp_customize WP_Customizer
	 * @param $f
	 * @param $id
	 * @param $args
	 *
	 * @internal param array $sections Sections and thier fields
	 */
	public function render_customizer_field( $wp_customize, $f, $id, $args ){
		//Add control by type
		if ( in_array( $f['type'], array( 'color', 'image', 'sf-text', 'sf-heading', 'sf-divider', ) ) ) {

			$this->cool_fields( $wp_customize, $f['type'], $id, $args );
			return;

		}

		//Setting type
		$args['type'] = $f['type'];

		if ( 'font' == $f['type'] ) {

			$args['choices'] = $this->get_fonts();
			$args['type'] = 'select';

		} elseif ( in_array( $f['type'], array( 'radio', 'select', ) ) ) {

			$args['choices'] = empty( $f['choices'] ) ? array( 'Choice 1', 'Choice 2', 'Choice 3' ) : $f['choices'];

		}

		$wp_customize->add_control(
			$id,
			$args
		);

	}

	/**
	 * Array of fonts for font controls
	 *
	 * @since	1.0.0
	 * @return array Fonts
	 */
	public function cool_fields( $wp_customize, $type, $id, $args ){
		$field_class = '';
		switch ( $type ) {
			case 'color':
				$field_class .= 'WP_Customize_Color_Control';
				break;

			case 'image':
				$field_class .= 'WP_Customize_Image_Control';
				break;

			case 'sf-text':
				if( empty( $args['description'] ) ){ $args['description'] = $args['label']; }
			case 'sf-heading':
			case 'sf-divider':
				$field_class .= 'Arbitrary_Storefront_Control';
				$args['type'] = str_replace( 'sf-', '', $type );
				break;
		}

		if ( '' != $field_class ){
			$wp_customize->add_control(
				new $field_class(
					$wp_customize,
					$id,
					$args
				)
			);
		}
	}

	/**
	 * Array of fonts for font controls
	 *
	 * @since	1.0.0
	 * @return array Fonts
	 */
	public function get_fonts(){
		return array(
			'times'     => 'Times New Roman',
			'arial'     => 'Arial',
			'courier'   => 'Courier New',
		);
	}

}