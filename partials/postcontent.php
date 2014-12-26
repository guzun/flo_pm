<section class="story cf">
	<?php add_filter('the_content', 'flo_lazyload_images', 1);
	the_content();
	remove_filter('the_content', 'flo_lazyload_images', 1);
	?>
</section>
<?php wp_link_pages(array(
	'before' => '<section class="story-pages"><p>' . __('Pages:', 'flotheme'),
	'after'	 => '</p></section>',
)) ?>