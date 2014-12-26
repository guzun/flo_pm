<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<section>
		<h3><?php the_title(); ?></h3>
		<?php the_post_thumbnail(); ?>

		<?php $peoples = get_field('members'); ?>
		<?php if($peoples) : ?>
			<ul class="people">
				<?php foreach($peoples as $people) : ?>
					<li>
						<figure>
							<?php $url = wp_get_attachment_url( get_post_thumbnail_id($people->ID) ); ?>
							<img src="<?php echo $url; ?>">
							<figcaption>
								<a href="<?php echo get_permalink($people->ID); ?>"><?php echo get_the_title($people->ID) ?></a>
							</figcaption>
						</figure>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

		

		<div class="story"><?php the_content(); ?></div>
	</section>
<?php endwhile; else: ?>
	<?php flo_part('notfound')?>
<?php endif; ?>
<?php get_footer(); ?>