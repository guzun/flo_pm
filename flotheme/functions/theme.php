<?php 

/*
*  Create a simple sub options page called 'Footer'
*/
add_filter('acf/options_page/settings', 'my_options_page_settings');
function my_options_page_settings($option)
{
	$option['title'] = __('Flotheme');
	$option['pages'] = array(
		__('General'),
		__('Gallery'),
		__('Social')
	);
	return $option;
}

?>