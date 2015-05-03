Storefront Extension Boilerplate For Lazy Developers
====================================================

This contains separate classes for admin and public sections, and another for  rendering customizer controls, all inheriting *Storefront_Extension_Boilerplate_Abstract* class

######We have changed the way we put the controls in the customizer, just put an array with control data in **$storefront_extension_boilerplate_customizer_fields** check out includes/vars-n-funcs.php for more details.

**Cool stuff is that *sections are automatically created too*, Just put in the label, id, section and type in field array, the sections will automatically created.**

#####For example, changing $storefront_extension_boilerplate_customizer_fields to
```php
$storefront_extension_boilerplate_customizer_fields = array(

	array(
		'id'        => 'search-box-placeholder',
		'label'     => 'Search box placeholder text',
		'section'   => 'Storefront Header products search',
		'type'      => 'text',
	),
	array(
		'id'        => 'search-box-color',
		'label'     => 'Header search color',
		'section'   => 'Storefront Header products search',
		'type'      => 'image',
	),
);
```

#####Will create 2 fields,
1. **search_box_placeholder** text field
2. **search_box_color** color field
both prefixed with **storefront-extension-boilerplate-*

#####and a section with label 'Storefront Header products search' and id '*storefront-extension-boilerplate-section-storefront-header-products-search*'.

To get the value in public class use $this->get_theme_mod( $id, $default ). e.g.
```php
$color = $this->get_theme_mod( 'search_box_color', $fff );
$css = "";
$css .= ".site-search .search-field \n";
$css .= "\t background: {$color} \n";
$css .= "} \n";
wp_add_inline_style( 'seb-styles', $css );
```
in Storefront_Extension_Boilerplate_Public::styles method will probably set background color for product search

To put controls in existing sections prefix the existing sections name with *'existing_'* and it's good to go.

It will create as many controls and sections as you want :wink:

You can see all the supported field types in Storefront Extension Boilerplate section in customizer.

Below are James Koster's comments

A simple plugin boilerplate to fast-track your Storefront extension development.

To get started:
 * change the directory name,
 * storefront-extension-boilerplate.php,
 * languages/storefront-extension-boilerplate.po
to reflect your new plugin name.

Then do some Find/Replace (case sensitive) across the entire directory:

* 'storefront-extension-boilerplate' => 'your-extension'
* 'Storefront_Extension_Boilerplate' => 'Your_Extension'
* 'Storefront Extension Boilerplate' => 'Your Extension'
* 'storefront_extension_boilerplate_' => 'your_extension_'
* 'seb_' => 'ye_'
* 'seb-' => 'ye-'

That's it! Start building!
