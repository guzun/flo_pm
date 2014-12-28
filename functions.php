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

/*register_field_group(array (
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
*/

register_field_group(array (
		'id' => 'acf_project-status',
		'title' => 'Project Status',
		'fields' => array (
			array (
				'key' => 'field_549d65b09d072',
				'label' => 'Status',
				'name' => 'status',
				'type' => 'select',
				'choices' => array (
					'active' => 'Active',
					'closed' => 'Closed',
				),
				'default_value' => 'closed',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_549d663b14f39',
				'label' => 'Project stage',
				'name' => 'project_stage',
				'type' => 'select',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_549d65b09d072',
							'operator' => '==',
							'value' => 'active',
						),
					),
					'allorany' => 'all',
				),
				'choices' => array (
					'design' => 'Design',
					'development' => 'Development',
				),
				'default_value' => 'design',
				'allow_null' => 0,
				'multiple' => 1,
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'projects',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'side',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
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
		array (
			'key' => 'field_549d7bea85642',
			'label' => 'Brand files',
			'name' => 'project_brand_files',
			'prefix' => '',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'min' => '',
			'max' => '',
			'layout' => 'table',
			'button_label' => 'Add Row',
			'sub_fields' => array (
				array (
					'key' => 'field_549e9a8da14be',
					'label' => 'Title',
					'name' => 'brand_title',
					'prefix' => '',
					'type' => 'text',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'column_width' => '',
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
					'readonly' => 0,
					'disabled' => 0,
				),
				array (
					'key' => 'field_549d7c0a85643',
					'label' => 'Files',
					'name' => 'brand_file',
					'prefix' => '',
					'type' => 'file',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'column_width' => '',
					'return_format' => 'url',
					'library' => 'all',
				),
			),
		),
		array (
			'key' => 'field_549d7c7b351e0',
			'label' => 'Design source files',
			'name' => 'project_design_source_files',
			'prefix' => '',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'min' => '',
			'max' => '',
			'layout' => 'table',
			'button_label' => 'Add Row',
			'sub_fields' => array (
				array (
					'key' => 'field_549e9a9da24be',
					'label' => 'Title',
					'name' => 'source_title',
					'prefix' => '',
					'type' => 'text',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'column_width' => '',
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
					'readonly' => 0,
					'disabled' => 0,
				),
				array (
					'key' => 'field_549d7cee351e1',
					'label' => 'Files',
					'name' => 'source_files',
					'prefix' => '',
					'type' => 'file',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'column_width' => '',
					'return_format' => 'url',
					'library' => 'all',
				),
			),
		),
		array (
			'key' => 'field_549d7d8af694a',
			'label' => 'Scope of work',
			'name' => 'project_scope_of_work',
			'prefix' => '',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'min' => '',
			'max' => '',
			'layout' => 'table',
			'button_label' => 'Add Row',
			'sub_fields' => array (
				array (
					'key' => 'field_543e1a8da14be',
					'label' => 'Title',
					'name' => 'scope_title',
					'prefix' => '',
					'type' => 'text',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'column_width' => '',
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
					'readonly' => 0,
					'disabled' => 0,
				),
				array (
					'key' => 'field_549d7dacf694b',
					'label' => 'Files',
					'name' => 'scope_file',
					'prefix' => '',
					'type' => 'file',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'column_width' => '',
					'return_format' => 'url',
					'library' => 'all',
				),
			),
		),
		array (
			'key' => 'field_549e7f62a14bd',
			'label' => 'Links',
			'name' => 'projects_links',
			'prefix' => '',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'min' => '',
			'max' => '',
			'layout' => 'row',
			'button_label' => 'Add Row',
			'sub_fields' => array (
				array (
					'key' => 'field_549e7f8da14be',
					'label' => 'Title',
					'name' => 'project_link_title',
					'prefix' => '',
					'type' => 'text',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'column_width' => '',
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
					'readonly' => 0,
					'disabled' => 0,
				),
				array (
					'key' => 'field_549e7fa6a14bf',
					'label' => 'Link',
					'name' => 'project_link',
					'prefix' => '',
					'type' => 'text',
					'instructions' => '',
					'required' => 1,
					'conditional_logic' => 0,
					'column_width' => '',
					'default_value' => 'http://',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
					'readonly' => 0,
					'disabled' => 0,
				),
			),
		),
		array (
			'key' => 'field_543t1a2da14be',
			'label' => 'Invision preview project link',
			'name' => 'invision_priview',
			'prefix' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'column_width' => '',
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_54431a2de14be',
			'label' => 'Live preview project link',
			'name' => 'live_priview',
			'prefix' => '',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'column_width' => '',
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
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