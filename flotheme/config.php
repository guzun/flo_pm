<?php
/**
 * Get current theme options
 * Example: http://projects.flosites.com/projects/flosites-coretheme/wiki/Options_Example
 * @return array
 */
function flotheme_get_options() {

	$options = array();

	$options[] = array("name" => "Theme",
						"type" => "heading");

	$options[] = array( "name" => "Copyrights",
						"desc" => "Your copyright message.",
						"id" => "flo_copyrights",
						"std" => "",
						"type" => "text");

	$options[] = array( "name" => "Social",
						"type" => "heading");

	$options[] = array( "name" => "Facebook",
						"desc" => "Your facebook profile URL.",
						"id" => "flo_fb",
						"std" => "",
						"type" => "text");

	$options[] = array( "name" => "Facebook Application ID",
						"desc" => "If you have Application ID you can connect the blog to your Facebook Profile and monitor statistics there.",
						"id" => "flo_fb_id",
						"std" => "",
						"type" => "text");

	$options[] = array( "name" => "Enable Open Graph",
						"desc" => "The <a href=\"http://www.ogp.me/\">Open Graph</a> protocol enables any web page to become a rich object in a social graph.",
						"id" => "flo_og_enabled",
						"std" => "",
						"type" => "checkbox");

	$options[] = array( "name" => "Twitter",
						"desc" => "Your twitter username.",
						"id" => "flo_twi",
						"std" => "",
						"type" => "text");

	$options[] = array( "name" => "Advanced Settings",
						"type" => "heading");

	$options[] = array( "name" => "Google Analytics",
						"desc" => "Please insert your Google Analytics code here. Example: <strong>UA-22231623-1</strong>",
						"id" => "flo_ga",
						"std" => "",
						"type" => "text");

	return $options;
}

/**
 * Add custom scripts to Options Page
 */
function flotheme_options_custom_scripts() {
 ?>
<script type="text/javascript">
	jQuery(document).ready(function() {});
</script>
<?php
}

/**
 * Add Metaboxes
 * Examples: http://projects.flosites.com/projects/flosites-coretheme/wiki/Metaboxes_Example
 * @param array $meta_boxes
 * @return array
 */
function flotheme_metaboxes($meta_boxes) {

	$meta_boxes = array(
//            array(
//                'id' => 'projects_team',
//                'title' => 'Team Members',
//                'context' => 'side',
//                'priority' => 'high',
//                'show_names' => false,
//                'fields' => array(
//                    array(
//                        'id' => 'team_id',
//                        'type' => 'custom_post_select_multicheck',
//                        'post_type' => 'team',
//                        'multiple' => true
//                    ),
//                ),
//                'pages' => array('projects'),
//            ),
            
        );

	return $meta_boxes;
}

/**
 * Get image sizes for images
 * Example: http://projects.flosites.com/projects/flosites-coretheme/wiki/Images_Sizes_Example
 * @return array
 */
function flotheme_get_images_sizes() {
	return array();
}

/**
 * Add post types that are used in the theme
 * Example: http://projects.flosites.com/projects/flosites-coretheme/wiki/Post_Types_Example
 * @return array
 */
function flotheme_get_post_types() {
	return array(
            'projects' => array(
			'config' => array(
				'public' => true,
				'exclude_from_search' => false,
				'has_archive'   => false,
				'supports'=> array(
					'title',
                                        'editor',
                                        'thumbnail',
				),
				'show_in_nav_menus'=> false,
                                'rewrite' => array('slug'=>'project', 'with_front'=>false),
                                //'menu_icon' => THEME_URL . '/images/icons/project.png'
			),
			'singular' => 'Project',
			'multiple' => 'Projects',
			'columns'	=> array(
				'first_image',
			)
		),
            'team' => array(
			'config' => array(
				'public' => true,
				'exclude_from_search' => false,
				'has_archive'   => false,
				'supports'=> array(
					'title',
                                        'editor',
                                        'thumbnail',
				),
				'show_in_nav_menus'=> false,
                                'rewrite' => array('slug'=>'project', 'with_front'=>false),
                                //'menu_icon' => THEME_URL . '/images/icons/project.png'
			),
			'singular' => 'Team Member',
			'multiple' => 'Team Members',
			'columns'	=> array(
				'first_image',
			)
		),
            'client' => array(
			'config' => array(
				'public' => false,
                                'show_ui' => true,
				'exclude_from_search' => false,
				'has_archive'   => false,
				'supports'=> array(
					'title',
                                        'editor',
                                        'thumbnail',
				),
				'show_in_nav_menus'=> false,
                                //'rewrite' => array('slug'=>'project', 'with_front'=>false),
                                //'menu_icon' => THEME_URL . '/images/icons/project.png'
			),
			'singular' => 'Client',
			'multiple' => 'Clients',
			'columns'	=> array(
				'first_image',
			)
		),
        );
}

/**
 * Add taxonomies that are used in theme
 * Example: http://projects.flosites.com/projects/flosites-coretheme/wiki/Taxonomy_Example
 * @return array
 */
function flotheme_get_taxonomies() {
	return array(
            'project-category' => array(
                'for' => array('projects'),
                'config' => array(
                    'sort' => true,
                    'args' => array('orderby' => 'term_order'),
                    'hierarchical' => true,
                    'rewrite' => array( 'slug' => 'projects', 'with_front' => false ),
                    'show_in_nav_menus'=> true,
                    'show_admin_column' => true
                ),
                'singular' => 'Category',
                'multiple' => 'Categories',
                'query_var'=>true
            ),
            'project-technologies' => array(
                'for' => array('projects', 'team'),
                'config' => array(
                    'sort' => true,
                    'args' => array('orderby' => 'term_order'),
                    'hierarchical' => true,
                    'rewrite' => array( 'slug' => 'projects', 'with_front' => false ),
                    'show_in_nav_menus'=> true,
                    'show_admin_column' => true
                ),
                'singular' => 'Technology',
                'multiple' => 'Technologies',
                'query_var'=>true
            ),
            'team-category' => array(
                'for' => array('team'),
                'config' => array(
                    'sort' => true,
                    'args' => array('orderby' => 'term_order'),
                    'hierarchical' => true,
                    'rewrite' => array( 'slug' => 'projects', 'with_front' => false ),
                    'show_in_nav_menus'=> true,
                    'show_admin_column' => true
                ),
                'singular' => 'Category',
                'multiple' => 'Categories',
                'query_var'=>true
            ),
//            'project-team' => array(
//                'for' => array('projects'),
//                'config' => array(
//                    'sort' => true,
//                    'args' => array('orderby' => 'term_order'),
//                    'hierarchical' => true,
//                    'rewrite' => array( 'slug' => 'projects', 'with_front' => false ),
//                    'show_in_nav_menus'=> true,
//                    'show_admin_column' => true
//                ),
//                'singular' => 'Team',
//                'multiple' => 'Team',
//                'query_var'=>true
//            ),
        );
}

/**
 * Add post formats that are used in theme
 *
 * @return array
 */
function flotheme_get_post_formats() {
	return array(
		// uncomment if you want to use post formats
		// 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'
	);
}

/**
 * Get sidebars list
 *
 * @return array
 */
function flotheme_get_sidebars() {
	$sidebars = array(
		// uncomment if you want to use sidebars
		// you can add new sidebar ex.: 'id' => 'title'
		// you can display specific sidebar with function dynamic_sidebar('id')
		// 'general-sidebar' => 'General Sidebar'
	);
	return $sidebars;
}

/**
 * Predefine custom sliders
 * to get slider use:
 * $slider = flo_sliders_get_slider('sneak-peek');
 * @return array
 */
function flotheme_get_sliders() {
	return array(
		// uncomment if you want to use sliders
		// 'sneak-peek' => array(
		// 	'title'		=> 'Sneak Peek',
		// ),
	);
}

/**
 * Post types where metaboxes should show
 * @return array
 */
function flotheme_get_post_types_with_gallery() {
	return array('post');
}

/**
 * Add custom fields for media attachments
 * Example: http://projects.flosites.com/projects/flosites-coretheme/wiki/Media_Custom_Fields_Example
 * @return array
 */
function flotheme_media_custom_fields() {
	return array();
}