<?php
	global $the_query;

	$wp_query = $the_query;
	
	$wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

	$pagination = array(
			'base' => @add_query_arg('paged','%#%'),
			'format' => '',
			'total' => $wp_query->max_num_pages,
			'current' => $current,
			'show_all' => false,
			'prev_text'=> __('Previous','flotheme'),
			'next_text'=> __('Next','flotheme'),
			'type' => 'array'
			);

	if( $wp_rewrite->using_permalinks() ){
			$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 'type' , remove_query_arg( 's', get_pagenum_link( 1 ) ) ) ) . 'page/%#%/', 'paged' );
    }

	if( !empty($wp_query->query_vars['s'] ) ){
			$pagination['add_args'] = array( 's' => urlencode( get_query_var( 's' ) ) );
    }

   
	//$pgn = paginate_links( $pagination );
	$pgn = paginate_links_array( $pagination );

	//  print '<pre style="margin:10px; border:1px dashed #999999; padding:10px; color:#333; background:#ffffff;">';
	// 	var_dump($pgn);
	// print '</pre>';
	
	
	if( $current == 1 ){
		$current--;
	}
	
	if(!empty($pgn)){
		echo '<div class="pag flo-projects-filter">';
		echo '<ul class="b_pag center p_b">';
		foreach($pgn as $k => $link){
			$classes =  (isset($link->classes) ? implode(' ', $link->classes) : '');
			print '<li>';
				if(strstr($classes, 'current')){
					print '<span class="'.$classes.'" data-pagenumber="'.$link->pagenumber.'">'.$link->text.'</span>';
				}else{
					print '<a  class="'.$classes.'" href="'.$link->url.'" data-pagenumber="'.$link->pagenumber.'">'.$link->text.'</a>';
				}
			print '</li>';
		}
		echo '</ul>';
		echo '<input type="hidden" name="flo_page_number" class="flo-page-number" value="'.$current.'">';
		echo '</div>';
	}

?>

