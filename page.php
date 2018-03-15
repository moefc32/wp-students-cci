<?php get_header(); get_template_part('res/php/navigator'); ?>

<div class="container">
	<div class="col-sm-8">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<header>
				<section class="article-title">
					<h1><?php the_title(); ?></h1>
				</section>
			</header>
			<div class="article-date">
				<div class="row">
					<div class="col-xs-12 text-left">
						<i class="fa fa-calendar fa-fw"></i> <?php echo get_the_time(get_option('date_format')); ?>
					</div>
				</div>
			</div>
			<article>
				<?php the_content(); ?>
			</article>
			<?php if (comments_open() || get_comments_number()) : ?>
				<hr/>
				<?php comments_template();
			endif; ?>
		<?php endwhile; else: ?>
			<p><?php __('Halaman tidak tersedia.', 'students'); ?></p>
		<?php endif; ?>
	</div>
	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>