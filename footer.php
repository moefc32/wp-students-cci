<footer class="container-fluid upper-footer">
	<div class="container">
		<div class="col-sm-4 col-md-3 kotakan">
			<img alt="Students" src="<?php echo esc_url(get_template_directory_uri()) ?>/res/image/students.png"><hr>
			<address>
				<?php if (is_active_sidebar('address-widget')) {
					dynamic_sidebar('address-widget');
				} ?>
			</address>
		</div>
		<div class="col-sm-4 col-md-offset-1">
			<span class="footer-title"><i class="fa fa-link fa-fw"></i>TAUTAN</span>
			<hr>
			<?php if (is_active_sidebar('other-links-widget')) {
				dynamic_sidebar('other-links-widget');
			} ?>
		</div>
		<div class="col-sm-4">
			<span class="footer-title"><i class="fa fa-phone fa-fw"></i> KONTAK</span>
			<hr>
			<?php if (is_active_sidebar('contact-us-widget')) {
				dynamic_sidebar('contact-us-widget');
			} ?>
		</div>
	</div>
</footer>
<footer class="container-fluid lower-footer">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-8 footer-page">
				
				<?php if (is_active_sidebar('footer-widget')) { ?>
					<span class="rss hidden-xs"><a href="<?php bloginfo('rss2_url'); ?>"><i class="fa fa-rss fa-fw"></i> RSS</a></span>
					<?php dynamic_sidebar('footer-widget');
				} ?>
			</div>
			<div class="col-xs-12 col-sm-4 credits">Students CCI &copy; 2009 - <?php echo date("Y") ?>, <em>theme by</em> <a href="https://mf-chan.com">Mfc</a></div>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>