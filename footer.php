	</div><!-- /#content -->
	<footer id="footer-main" class="footer-main cf" role="contentinfo">
		<p class="copy">
		<?php if (flo_get_option('copyrights')) : ?>
			<?php echo flo_option('copyrights'); ?>
		<?php else: ?>
			&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>
		<?php endif; ?>
		</p>
		<p class="madeby">
			<?php _e('Made By', 'flotheme'); ?> <a href="http://flosites.com" rel="external"><?php _e('Flosites', 'flotheme'); ?></a>
		</p>
	</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>