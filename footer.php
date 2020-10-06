	<footer class="footer">
		<div class="widget-area">
			<div class="footer-widget">
				<?php if ( is_active_sidebar( 'footer-widget' ) ) : ?>
				<?php dynamic_sidebar( 'footer-widget' ); ?>
				<?php endif; ?>
			</div>

			<div class="footer-widget2">
				<?php if ( is_active_sidebar( 'footer-widget2' ) ) : ?>
				<?php dynamic_sidebar( 'footer-widget2' ); ?>
				<?php endif; ?>
			</div>
		</div>

		<p class="copyright"><small>&copy; <?php echo date( 'Y' ) . " " . get_bloginfo( 'name' ); ?> ALL RIGHTS RESERVED.</small></p>
	</footer>
	<a class="pagetop-btn" href="#wrapper"><i class="fas fa-angle-up"></i></a>
</div><!-- /#wrapper -->
<?php wp_footer(); ?>
</body>
</html>