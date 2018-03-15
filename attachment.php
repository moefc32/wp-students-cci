<?php get_header(); get_template_part('res/php/navigator'); ?>

<div class="container">
	<div class="col-sm-8">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<section class="article-title">
				<h3><i class="fa fa-file-o fa-fw"></i> <em>Attachment</em> : <?php the_title(); ?></h3>
			</section>
			<div class="article-date">
				<div class="row">
					<div class="col-xs-12 text-left">
						<i class="fa fa-calendar fa-fw"></i> <?php echo get_the_time(get_option('date_format')); ?> <i class="fa fa-user fa-fw"></i> <?php echo the_author_posts_link(); ?>
					</div>
				</div>
			</div>
			<article>
				<?php if (wp_attachment_is_image($post->id)) : $att_image = wp_get_attachment_image_src($post->id, "full"); ?>
					<img src="<?php echo $att_image[0];?>" class="text-center" style="max-width: 100%;" alt="<?php $post->post_excerpt; ?>"/>
					<section class="alert alert-success" style="margin-top: 10px;">
						<div class="media">
							<div class="media-left">
								<i class="fa fa-file-image-o fa-5x fa-fw"></i>
							</div>
							<div class="media-body">
								<h3>Image : <small><?php echo basename($post->guid) ?></small></h3>
								<a href="<?php echo wp_get_attachment_url($post->id); ?>" class="btn btn-default" rel="attachment">
									<i class="fa fa-download fa-fw"></i> Unduh
								</a>
							</div>
						</div>
					</section>
				<?php else : ?>
					<section class="alert alert-success" style="margin-top: 10px;">
						<div class="media">
							<div class="media-left">
								<i class="fa fa-file-o fa-5x fa-fw"></i>
							</div>
							<div class="media-body">
								<h3>File : <small><?php echo basename($post->guid) ?></small></h3>
								<a href="<?php echo wp_get_attachment_url($post->id); ?>" class="btn btn-default" rel="attachment">
									<i class="fa fa-download fa-fw"></i> Unduh
								</a>
							</div>
						</div>
					</section>
				<?php endif; ?>
			</article>
		<?php endwhile; else: ?>
			<p><?php __('Dokumen tidak tersedia.', 'students'); ?></p>
		<?php endif; ?>
	</div>
	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>