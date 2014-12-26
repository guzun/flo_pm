<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="home-page">
		<div class="team-category">
			<a href="#">designers</a>
			<a href="#">developers</a>
		</div>
		<div class="active-projects">
			<div class="developers-projects">
				<?php
					$args = array(
						'post_type'   => 'projects',
						'post_status' => 'publish',
						'posts_per_page'  => -1,
						'order'      => 'DESC',
						'orderby'    => 'date',
						'paged' => $paged,
						'meta_query' => array(
						'relation' => 'AND',
						array(
							'key'     => 'status',
							'value'   => 'active',
							'compare' => 'LIKE'
						),
						array(
							'key'     => 'project_stage',
							'value'   => 'development',
							'compare' => 'LIKE'
						)),
					);
					$wp_query = new WP_Query( $args );

					$count_posts = $wp_query->post_count;

					$user_id = $wp_query->posts[0]->ID;
					$users = get_field('members', $user_id, $format_value);
				?>
				<?php if ($wp_query->have_posts()): ?>
					<div class="header-box">
						<div class="count-projects">
							<?php echo $count_posts; ?>
						</div>
						<div class="change-grid">
							<b class="line">line</b>
							<b class="boxes">boxes</b>
						</div>
					</div>
					<div class="items-projects">
						<ul>
							<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>
								<li>
									<p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
									<div class="people">
										<?php var_dump($users); ?>
									</div>
								</li>
							<?php endwhile; ?>
						</ul>
					</div>
				<?php endif ?>
				<?php wp_reset_query(); ?>
			</div>
			<div class="designers-projects">
				<?php
					$args = array(
						'post_type'   => 'projects',
						'post_status' => 'publish',
						'posts_per_page'  => 2,
						'order'      => 'DESC',
						'orderby'    => 'date',
						'paged' => $paged,
						'meta_query' => array(
						'relation' => 'AND',
						array(
							'key'     => 'status',
							'value'   => 'active',
							'compare' => 'LIKE'
						),
						array(
							'key'     => 'project_stage',
							'value'   => 'design',
							'compare' => 'LIKE'
						)),
					);
					$wp_query = new WP_Query( $args );
					$count_posts = $wp_query->post_count;
				?>
				<?php if ($wp_query->have_posts()): ?>
					<div class="header-box">
						<div class="count-projects">
							<?php echo $count_posts; ?>
						</div>
						<div class="change-grid">
							<b class="line">line</b>
							<b class="boxes">boxes</b>
						</div>
					</div>
					<div class="item-projects">
						<ul>
							<?php while($wp_query->have_posts()): $wp_query->the_post(); ?>
								<li>
									<div class="info-project">
										<p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
									</div>
								</li>
							<?php endwhile; ?>
						</ul>
					</div>
				<?php endif ?>
				<?php wp_reset_query(); ?>
			</div>
		</div>
	</div>
<?php endwhile; else: ?>
	<?php flo_part('notfound')?>
<?php endif; ?>
<?php get_footer(); ?>