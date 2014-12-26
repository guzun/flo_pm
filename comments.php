<?php
	// Do not delete these lines for security reasons
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
		die ('Please do not load this page directly. Thanks!');
	}
?>
<div class="discussion">
	<section class="comments">
			<?php if (post_password_required()) : ?>
				<p class="comments-protected"><?php _e('This post is password protected. Enter the password to view comments.', 'flotheme'); ?></p>
			<?php
			return; endif; ?>
			<?php if (have_comments()) : ?>
			<div class="comments-in">
				<div class="scroll-pane">
					<ol class="commentlist">
						<?php wp_list_comments(array('callback' => 'flotheme_comment', 'max_depth' => 2)); ?>
					</ol>
				</div>
			</div>
				<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // are there comments to navigate through ?>
					<nav class="comments-nav" class="pager">
						<div class="previous"><?php previous_comments_link(__('&larr; Older comments', 'flotheme')); ?></div>
						<div class="next"><?php next_comments_link(__('Newer comments &rarr;', 'flotheme')); ?></div>
					</nav>
				<?php endif; // check for comment navigation ?>

				<?php if (!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
					<p class="comments-closed"><?php _e('Comments are closed.', 'flotheme'); ?></p>
				<?php endif; ?>
			<?php endif; ?>
			<?php if (!have_comments() && !comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')) : ?>
				<p class="comments-closed"><?php _e('Comments are closed.', 'flotheme'); ?></p>
			<?php endif; ?>
	</section>
	<?php if (comments_open()) : ?>
	<section class="respond">
		<?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>
			<p class="info"><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.', 'flotheme'), wp_login_url(get_permalink())); ?></p>
		<?php else : ?>
			<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" class="comment-form form">
				<div class="area1">
					<?php if (is_user_logged_in()) : ?>
						<p class="info"><?php printf(__('Logged in as <a href="%s/wp-admin/profile.php">%s</a>.', 'flotheme'), get_option('siteurl'), $user_identity); ?>
						<a href="<?php echo wp_logout_url(get_permalink()); ?>" title="<?php __('Log out of this account', 'flotheme'); ?>"><?php _e('Log out &raquo;', 'flotheme'); ?></a></p>
					<?php endif; ?>
					<?php if (!is_user_logged_in()) : ?>
						<div class="input-container">
							<input type="text" placeholder="Name" class="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" required="required">
						</div>
						<div class="input-container">
							<input type="email" placeholder="Email" class="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" required="required" email="true">
						</div>
						<div class="input-container">
							<input type="text" placeholder="Website" class="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3">
						</div>
					<?php endif; ?>
				</div>
				<div class="area2">
					<div class="input-container">
						<textarea placeholder="Message" name="comment" id="comment" class="input-xlarge" tabindex="4" rows="5" cols="40" required="required"></textarea>
					</div>
				</div>
				<div class="button-container">
					<button class="button red">Submit</button>
				</div>
				<div class="messages"></div>
				<p class="error"></p>
				<?php comment_id_fields(); ?>
				<?php do_action('comment_form', $post->ID); ?>
			</form>
		<?php endif; // if registration required and not logged in ?>
	</section>
	<?php endif; ?>
</div>