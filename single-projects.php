<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<section class="project-single">
		<div class="left-side">
			<div class="container">
				<a href="window.history.go(-1)" class="back">back to projects</a>
				<div class="status">
					<?php $value = get_field('project_stage'); ?>
					<?php if($value[0] == "development"): ?>
						<span>in dev</span>
					<?php else: ?>
						<span>in design</span>
					<?php endif; ?>
				</div>
				<h3><?php the_title(); ?></h3>
				<time pubdate="<?php the_time('c'); ?>"><?php the_time('F, Y');?></time>

				<?php $peoples = get_field('members'); ?>
				<?php if($peoples) : ?>
					<ul class="people">
						<?php foreach($peoples as $people) : ?>
							<li>
								<?php $url = wp_get_attachment_url( get_post_thumbnail_id($people->ID) ); ?>
								<img src="<?php echo $url; ?>">
								<a href="<?php echo get_permalink($people->ID); ?>"><?php echo get_the_title($people->ID) ?></a>
								<ul>
									<?php $terms = wp_get_post_terms($people->ID, 'team-category');?>
									<?php foreach ($terms as $term) : ?>
										<li><?php echo $term->name; ?></li>
									<?php endforeach; ?>
								</ul>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		</div>
		<div class="right-side">
			<div class="container">
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
										<div class="icon"></div>
										<a href="<?php the_sub_field('brand_file'); ?>"><?php the_sub_field('brand_title') ?></a>
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
										<div class="icon"></div>
										<a href="<?php the_sub_field('source_files'); ?>"><?php the_sub_field('source_title') ?></a>
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
										<div class="icon"></div>
										<a href="<?php the_sub_field('scope_file'); ?>"><?php the_sub_field('scope_title') ?></a>
									</li>
								<?php endwhile; ?>
							</ul>
						</li>
					<?php endif; ?>
					<?php if(get_field('invision_priview')) : ?>
						<li>
							<h4>invision preview project link</h4>
							<?php $xrt = explode('/', get_field('invision_priview'));?>
							<?php var_dump($xrt[count($xrt)-1]); ?>
							<a href="<?php the_field('invision_priview'); ?>"></a>
						</li>
					<?php endif; ?>
					<?php if(get_field('live_priview')) : ?>
						<li>
							<h4>live preview project link</h4>
							<?php $x = explode('/', get_field('live_priview'));?>
							<?php var_dump($xrt[count($xrt)-1]); ?>
							<a href="<?php the_field('live_priview'); ?>"></a>
							<?php 

							echo $x;



 ?>
						</li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
	</section>
<?php endwhile; else: ?>
	<?php flo_part('notfound')?>
<?php endif; ?>
<?php get_footer(); ?>