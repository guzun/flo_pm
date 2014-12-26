<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="home-page">
		<div class="team-category">
			
		</div>
		<div class="active-projects">
			<div class="developers-projects">
				<?php
					$args = array(
						'post_type'   => 'projects',
						'post_status' => 'publish',
						'posts_per_page'  => 2,
						'order'      => 'DESC',
						'orderby'    => 'date',
						'paged' => $paged,
						// 'meta_key' => 'status',
						// 'meta_value' => 'active'
						'meta_query' => array(
						'relation' => 'AND',
						array(
							'key'     => 'status',
							'value'   => 'active',
							'compare' => '='
						),
						array(
							'key'     => 'project_stage',
							'value'   => 'design',
							'compare' => '='
						)),
					);
					$wp_query = new WP_Query( $args );
				?>
				<?php if ($wp_query->have_posts()): ?>
					<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>
						<?php var_dump($args); ?>
						<p><?php the_title(); ?></p>
					<?php endwhile; ?>
				<?php endif ?>
				<?php wp_reset_query(); ?>
			</div>
			<div class="designers-projects"></div>
		</div>
	</div>
<?php endwhile; else: ?>
	<?php flo_part('notfound')?>
<?php endif; ?>
<?php get_footer(); ?>