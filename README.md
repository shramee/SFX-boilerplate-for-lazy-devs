Storefront Extension Boilerplate For Lazy Developers
====================================================

This contains separate classes for admin and public sections, and another for  rendering customizer controls, all inheriting *Storefront_Extension_Boilerplate_Abstract* class

**We have changed the way we put the controls in the customizer, just put an array with control data in *$storefront_extension_boilerplate_customizer_fields* check out includes/vars-n-funcs.php for more details.**

######*Sections are automatically created*, Just put in the label, id, section and type in field array, the sections will automatically created.

#####For example, changing $storefront_extension_boilerplate_customizer_fields to
```php
$storefront_extension_boilerplate_customizer_fields = array(

	array(
		'id'        => 'search-box-placeholder',
		'label'     => 'Search box placeholder text',
		'section'   => 'Header products search',
		'type'      => 'text',
	),
	array(
		'id'        => 'search-box-color',
		'label'     => 'Header search color',
		'section'   => 'Header products search',
		'type'      => 'image',
	),

	array(
		'id'        => 'hide-branding',
		'label'     => 'Hide site branding',
		'section'   => 'existing_title_tagline',
		'type'      => 'checkbox',
	),

	array(
		'id'        => 'hide-header-cart',
		'label'     => 'Hide header cart',
		'section'   => 'Header Cart',
		'type'      => 'checkbox',
	),

	array(
		'id'        => 'header-cart-display',
		'label'     => 'Header cart display',
		'section'   => 'Header Cart',
		'type'      => 'select',
		'choices'   => array(
		    'hide'  => 'Hide',
		    'icon'  => 'Icon Only',
		    'full'  => 'Icon and cart',
		)
	),
);
```

#####Will create 2 sections,
1. **storefront-extension-boilerplate-section-header-cart** with label Header Cart.
2. **storefront-extension-boilerplate-section-header-products-search** with label Header products search.

#####And 5 fields,
1. **storefront-extension-boilerplate-search_box_placeholder** text field in '**Header products search**' section
2. **storefront-extension-boilerplate-search_box_color** color control in '**Header products search**' section
3. **storefront-extension-boilerplate-hide-branding** checkbox control in existing '**Site Title & Tagline**' section
4. **storefront-extension-boilerplate-header-cart-display** select control in '**Header cart**' section
5. **storefront-extension-boilerplate-hide-header-cart** checkbox control in '**Header cart**' section

To get the value in public class use $this->get_theme_mod( $id, $default ). e.g.
```php
$color = $this->get_theme_mod( 'search_box_color', '#ffffff' );
$css = "";
$css .= ".site-search .search-field \n";
$css .= "{ \n";
$css .= "\t background: {$color} ;\n";
$css .= "} \n";
wp_add_inline_style( 'seb-styles', $css );
```
in Storefront_Extension_Boilerplate_Public::styles method will set background color for product search

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
