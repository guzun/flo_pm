<?php
/****************************************************************
 * DO NOT DELETE
 ****************************************************************/
if ( STYLESHEETPATH == TEMPLATEPATH ) {
	define('FLOTHEME_PATH', TEMPLATEPATH . '/flotheme');
	define('FLOTHEME_URL', get_bloginfo('template_directory') . '/flotheme');
} else {
	
	define('FLOTHEME_PATH', STYLESHEETPATH . '/flotheme');
	define('FLOTHEME_URL', get_bloginfo('stylesheet_directory') . '/flotheme');
}

require_once FLOTHEME_PATH . '/init.php';

/****************************************************************
 * You can add your functions here.
 * 
 * BE CAREFULL! Functions will dissapear after update.
 * If you want to add custom functions you should do manual
 * updates only.
 ****************************************************************/

if( function_exists('register_field_group') ):

register_field_group(array (
	'key' => 'group_549d3f6162f42',
	'title' => 'Project Status',
	'fields' => array (
		array (
			'key' => 'field_549d3f6722c2c',
			'label' => 'Status',
			'name' => 'status',
			'prefix' => '',
			'type' => 'select',
			'instructions' => '',
			'required' => 1,
			'conditional_logic' => 0,
			'choices' => array (
				'active' => 'Active',
				'closed' => 'Closed',
			),
			'default_value' => array (
			),
			'allow_null' => 0,
			'multiple' => 0,
			'ui' => 0,
			'ajax' => 0,
			'placeholder' => '',
			'disabled' => 0,
			'readonly' => 0,
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'projects',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'side',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
));

register_field_group(array (
	'key' => 'group_549d3cbc9f98b',
	'title' => 'Projects Fields',
	'fields' => array (
		array (
			'key' => 'field_549d3cc571e94',
			'label' => 'Members',
			'name' => 'members',
			'prefix' => '',
			'type' => 'relationship',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'post_type' => array (
				0 => 'team',
			),
			'taxonomy' => '',
			'filters' => array (
				0 => 'search',
			),
			'elements' => '',
			'max' => '',
			'return_format' => 'object',
		),
		array (
			'key' => 'field_549d3cea56565',
			'label' => 'Client',
			'name' => 'client',
			'prefix' => '',
			'type' => 'relationship',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'post_type' => array (
				0 => 'client',
			),
			'taxonomy' => '',
			'filters' => array (
				0 => 'search',
			),
			'elements' => '',
			'max' => '',
			'return_format' => 'object',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'projects',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
));

endif;