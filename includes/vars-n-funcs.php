<?php
/**
 * Created by PhpStorm.
 * User: Shramee Srivastav <shramee.srivastav@gmail.com>
 * Date: 3/5/15
 * Time: 7:53 PM
 */

/**
 * Supported control types
 * * text
 * * checkbox
 * * radio (requires choices array in $args)
 * * select (requires choices array in $args)
 * * dropdown-pages
 * * textarea
 * * color
 * * image
 * * sf-text
 * * sf-heading
 * * sf-divider'
 *
 * sf- prefixed controls are arbitrary storefront controls
 *
 * NOTE : sf-text control doesn't show anything if description is not set but
 * in Storefront_Extension_Boilerplate_Customizer_Fields class we assign it to label
 * if not set ;)
 *
 */
$storefront_extension_boilerplate_customizer_fields = array(

	array(
		'id'        => 'sample-1',
		'label'     => 'Sample text control',
		'section'   => 'Storefront Extension Boilerplate',
		'type'      => 'text',
	),
	array(
		'id'        => 'sample-2',
		'label'     => 'Sample checkbox control',
		'section'   => 'Storefront Extension Boilerplate',
		'type'      => 'checkbox',
	),
	array(
		'id'        => 'sample-3',
		'label'     => 'Sample radio control',
		'section'   => 'Storefront Extension Boilerplate',
		'type'      => 'radio',
	),
	array(
		'id'        => 'sample-4',
		'label'     => 'Sample select control',
		'section'   => 'Storefront Extension Boilerplate',
		'type'      => 'select',
	),
	array(
		'id'        => 'sample-5',
		'label'     => 'Sample dropdown-pages control',
		'section'   => 'Storefront Extension Boilerplate',
		'type'      => 'dropdown-pages',
	),
	array(
		'id'        => 'sample-6',
		'label'     => 'Sample textarea control',
		'section'   => 'Storefront Extension Boilerplate',
		'type'      => 'textarea',
	),
	array(
		'id'        => 'sample-7',
		'label'     => 'Sample color control',
		'section'   => 'Storefront Extension Boilerplate',
		'type'      => 'color',
	),
	array(
		'id'        => 'sample-8',
		'label'     => 'Sample image control',
		'section'   => 'Storefront Extension Boilerplate',
		'type'      => 'image',
	),
	array(
		'id'        => 'sample-9',
		'label'     => 'Sample sf-text control',
		'section'   => 'Storefront Extension Boilerplate',
		'type'      => 'sf-text',
	),
	array(
		'id'        => 'sample-10',
		'label'     => 'Sample sf-heading control',
		'section'   => 'Storefront Extension Boilerplate',
		'type'      => 'sf-heading',
	),
	array(
		'id'        => 'sample-11',
		'label'     => 'Sample sf-divider control',
		'section'   => 'Storefront Extension Boilerplate',
		'type'      => 'sf-divider',
	),
	array(
		'id'        => 'sample-11-description',
		'label'     => 'sf-text control for describing Sample sf-divider control above ^ ',
		'section'   => 'Storefront Extension Boilerplate',
		'type'      => 'sf-text',
	),

);