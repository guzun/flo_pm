<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<section>
		<h3><?php the_title(); ?></h3>
		<?php the_post_thumbnail(); ?>
		<?php $terms = wp_get_post_terms($post->ID, 'project-technologies');?>
		<?php if ($terms) : ?>
			<ul class="category">
				<?php foreach ($terms as $term) : ?>
					<li><?php echo $term->name; ?></li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

		<ul class="files-section">
			<?php if (have_rows('project_brand_files')) : ?>
				<li>
					<?php $title = get_field_object('project_brand_files'); ?>
					<ul>
						<h4><?php echo $title['label']; ?></h4>
						<?php while(have_rows('project_brand_files')) : the_row(); ?>
							<li>
								<?php $x = explode('/', get_sub_field('brand_file'));?>
								<a href="<?php get_sub_field('brand_file'); ?>"><?php echo($x[count($x)-1]); ?></a>
							</li>
						<?php endwhile; ?>
					</ul>
				</li>
			<?php endif; ?>
			<?php if (have_rows('project_design_source_files')) : ?>
				<li>
					<?php $title = get_field_object('project_design_source_files'); ?>
					<ul>
						<h4><?php echo $title['label']; ?></h4>
						<?php while(have_rows('project_design_source_files')) : the_row(); ?>
							<li>
								<?php $x = explode('/', get_sub_field('source_files'));?>
								<a href="<?php get_sub_field('brand_file'); ?>"><?php echo($x[count($x)-1]); ?></a>
							</li>
						<?php endwhile; ?>
					</ul>
				</li>
			<?php endif; ?>
			<?php if (have_rows('project_scope_of_work')) : ?>
				<li>
					<?php $title = get_field_object('project_scope_of_work'); ?>
					<ul>
						<h4><?php echo $title['label']; ?></h4>
						<?php while(have_rows('project_scope_of_work')) : the_row(); ?>
							<li>
								<?php $x = explode('/', get_sub_field('scope_file'));?>
								<a href="<?php get_sub_field('brand_file'); ?>"><?php echo($x[count($x)-1]); ?></a>
							</li>
						<?php endwhile; ?>
					</ul>
				</li>
			<?php endif; ?>
		</ul>


		<?php $peoples = get_field('members'); ?>
		<?php if($peoples) : ?>
			<ul class="people">
				<?php foreach($peoples as $people) : ?>
					<li>
						<?php $url = wp_get_attachment_url( get_post_thumbnail_id($people->ID) ); ?>
						<img src="<?php echo $url; ?>">
						<a href="<?php echo get_permalink($people->ID); ?>"><?php echo get_the_title($people->ID) ?></a>
						<?php var_dump($people); ?>
						<span><?php echo get_field(); ?></span>
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