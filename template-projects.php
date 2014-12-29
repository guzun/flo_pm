<?php 
/**
 * Template Name: Projects
 */

get_header();


global $the_query;
// build the query the outputs the projects, then loop and output the info we need

if ( get_query_var('paged') ) {
    $current = get_query_var('paged');
} elseif ( get_query_var('page') ) {
    $current = get_query_var('page');
} else {
    $current = 1;
}
                	
		

$query_args = array(
	'post_type' => 'projects',
	'paged' => $current, 
	'posts_per_page' => 20
);

$the_query = new WP_Query( $query_args );

// The Loop
if ( $the_query->have_posts() ) {
	get_template_part( 'partials/filter' );
?>	
	<section class="flo-projects">

<?php
	
	
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		echo '<span>' . get_the_title() . '</span><br>';

	}
	get_template_part( 'partials/pagination' );
?>
	</section>	

<?php	
} else {
	echo 'Ooops, there are no Projects at the moment.';
}

get_footer();
?>