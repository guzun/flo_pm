<header class="preview">
	<div class="title cf">
		<h2><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title();?></a></h2>
		<div class="meta ta">
			<time pubdate="<?php the_time('c'); ?>"><?php the_time(get_option('date_format'));?></time>
			/
			<span class="categories"><?php the_category(', '); ?></span>
		</div>
		<?php if (flo_get_option('show_author')) : ?>
			<span class="by-author ta">
				<span class="av"><?php echo get_avatar(get_the_author_meta('email'), '36' ); ?></span>
				<span class="sep"><?php _e('by', 'flotheme'); ?></span>
				<span class="author vcard"><?php the_author_posts_link() ?></span>
			</span>
		<?php endif; ?>
	</div>
	
	<?php if (has_post_format('gallery')) : ?>
		<div class="flexslider ta">
			<ul class="slides">
				<?php foreach(flo_get_attached_images() as $image):?>
					<li><?php echo wp_get_attachment_image($image->ID, array(900, 600))?></li>
				<?php endforeach;?>
			</ul>
		</div>
	<?php elseif (has_post_thumbnail()):?>
		<figure>
			<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_post_thumbnail(array(900, 600))?></a>
		</figure>
	<?php else: ?>
		<?php flo_excerpt(); ?>
	<?php endif; ?>
</header>