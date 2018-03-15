<?php get_header(); get_template_part('res/php/navigator'); ?>

<div class="container">
	<div class="col-sm-8">
		<section class="alert alert-success">
			<div class="media">
				<div class="media-left">
					<i class="fa fa-search fa-5x fa-fw"></i>
				</div>
				<div class="media-body">
					<h2>Hasil pencarian untuk :</h2>
					<form method="get" id="search_form" action="<?php echo get_home_url(); ?>" role="search">
						<div class="input-group">
							<input type="text" class="form-control" name="s" placeholder="Cari..." value="<?php printf(__('%s', 'students'), get_search_query()); ?>">
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
							</span>
						</div>
					</form>
				</div>
			</div>
		</section>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="media">
				<div class="media-left">
					<?php if (has_post_thumbnail()) { ?>
						<section class="img-thumbnail">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
								<?php the_post_thumbnail(array(128, 128)); ?>
							</a>
						</section>
					<?php } ?>
				</div>
				<div class="media-body">
					<section class="article-title">
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					</section>
					<div class="article-date">
						<div class="row">
							<div class="col-xs-6 text-left">
								<i class="fa fa-calendar fa-fw"></i> <?php echo get_the_time(get_option('date_format')); ?> <i class="fa fa-user fa-fw"></i> <?php echo the_author_posts_link(); ?>
							</div>
							<div class="col-xs-6 text-right">
								<i class="fa fa-tag fa-fw"></i> <?php the_category(', '); ?>
							</div>
						</div>
					</div>
					<?php the_excerpt(); ?>
					<div class="pull-right">
						<a class="btn btn-danger btn-sm" href="<?php echo get_permalink() ?>">Selanjutnya &raquo;</a>
					</div>
				</div>
			</div>
		<?php endwhile;
		if (function_exists("wp_bs_pagination")) { wp_bs_pagination(); } ?>
		<?php else: ?>
			<p><?php __('Hasil tidak ditemukan.', 'students'); ?></p>
		<?php endif; ?>
	</div>
	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>