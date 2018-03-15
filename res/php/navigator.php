<?php if (!is_home() && !is_front_page()) : ?>

	<div class="container-fluid hidden-xs news">
		<div class="container">
			<strong class="trend">TERBARU</strong>
			<ul class="trending">
				<?php $query = new WP_Query(apply_filters('ticker_query_args', array('orderby' => 'date', 'order' => 'desc'))); ?>
				<?php while($query->have_posts()): $query->the_post(); ?>
					<li><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</ul>
		</div>
	</div>

<?php endif; ?>

<div class="container hidden-xs">
	<div class="navbar navbar-default">
		<div class="collapse navbar-collapse">
			<?php wp_nav_menu(array('fallback_cb' => 'walker_fallback', 'theme_location' => 'primary', 'depth' => 2, 'container' => false, 'menu_class' => 'nav navbar-nav', 'walker' => new wp_bootstrap_navwalker())); ?>
		</div>
	</div>
</div>