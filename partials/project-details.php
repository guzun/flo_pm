<div class="result-item">
	<div class="result-item-inner">
		<div class="result-image">
			
			<?php 
			if(has_post_thumbnail()){
				the_post_thumbnail( 'thumbnail' );
			}else{
			?><img src="http://lorempixel.com/500/500" alt="" /><?php	
			} 
			?>
		</div>
		<div class="result-meta">
			<a href="<?php echo get_the_permalink(); ?>" class="result-item-link"></a>
			<div class="result-meta-inner">
				<div class="name"><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></div>
				<div class="category"><?php echo get_the_term_list( get_the_ID(), 'project-category', '', ', ', '' ); ?> </div>
				<div class="member">
					<a href="#">Member 1,</a>
					<a href="#">Member 2</a>
				</div>
				<div class="date"><?php the_date(); ?></div>
				<?php  
					$status = get_field('status', get_the_ID()); 
					if(!strlen($status)){  
						$status = 'closed';
					}
				?>
				<div class="status <?php echo $status; ?>"><span></span> <?php echo $status; ?></div>
			</div>
		</div>
	</div>
</div>
