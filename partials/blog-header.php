<?php
	$blog_title = '';

	if (is_category()) {
		$blog_title = single_cat_title( '', false );
	} else if (is_tag()) {
		$blog_title = 'Tag: ' . single_tag_title( '', false );
	} else if (is_author()) {
		if (have_posts()) {
			the_post();
			$blog_title = 'Author: ' . get_the_author();
		}
		rewind_posts();
	} else if (is_search()) {
		$blog_title = sprintf( __( 'Search Results for: %s', 'flotheme' ), '<span>' . get_search_query() . '</span>' );
	} else if (is_archive()) {
		if (is_day()) {
			$blog_title = 'Daily Archives: ' . get_the_date();
		} elseif (is_month()) {
			$blog_title = 'Monthly Archives ' . get_the_date( _x( 'F Y', 'monthly archives date format', 'flotheme'));
		} elseif (is_year()) {
			$blog_title = 'Yearly Archives ' . get_the_date( _x( 'Y', 'yearly archives date format', 'flotheme'));
		} else {
			$blog_title = 'Blog';
		}
	} else {

	}

	if ($blog_title) {
		flo_page_title($blog_title);
	}
