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
			$pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 'fp_type' , remove_query_arg( 'type' , remove_query_arg( 's', get_pagenum_link( 1 ) ) ) ) ) . 'page/%#%/', 'paged' );
    }

	if( !empty($wp_query->query_vars['s'] ) ){
			$pagination['add_args'] = array( 's' => urlencode( get_query_var( 's' ) ) );
    }

    if( !empty( $wp_query->query_vars['fp_type'] ) ){
			$pagination['add_args'] = array( 'fp_type' => get_query_var( 'fp_type' ) );
    }

	$pgn = paginate_links( $pagination );
	if( $current == 1 ){
		$current--;
	}

	if(!empty($pgn)){
		echo '<div class="pag">';
		echo '<ul class="b_pag center p_b">';
		foreach($pgn as $k => $link){
			print '<li>' . str_replace( "'" , '"' , $link ) . '</li>';
		}
		echo '</ul>';
		echo '</div>';
	}

?>