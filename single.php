<?php get_header();
get_template_part('res/php/navigator'); ?>

<div class="container">
    <div class="col-sm-8">
        <?php if (is_active_sidebar('upper-note')) {
            dynamic_sidebar('upper-note');
        }
        if (have_posts()) : while (have_posts()) : the_post(); ?>
                <section class="article-featured">
                    <?php $caption = get_post(get_post_thumbnail_id())->post_excerpt;
                    $url     = get_permalink();
                    if (is_single()) :
                        $url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                        $url = $url[0];
                    endif; ?>
                    <?php the_post_thumbnail('post-thumbnail', ['class' => 'main-full featured-image', 'title' => strip_tags(get_the_title()), 'itemprop' => 'image']); ?>
                    <?php if (!empty($caption)) : ?>
                        <div class="caption"><?php echo $caption; ?></div>
                    <?php endif; ?>
                </section>
                <header>
                    <section class="article-title">
                        <h1><?php the_title(); ?></h1>
                    </section>
                </header>
                <section class="article-date">
                    <div class="row">
                        <div class="col-xs-6 text-left">
                            <i class="fa fa-calendar fa-fw"></i> <?php echo get_the_time(get_option('date_format')); ?> <i class="fa fa-user fa-fw"></i> <?php echo the_author_posts_link(); ?>
                        </div>
                        <div class="col-xs-6 text-right">
                            <i class="fa fa-tag fa-fw"></i> <?php the_category(', '); ?>
                        </div>
                    </div>
                </section>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php the_content(); ?>
                </article>
                <section class="article-keyword">
                    <i class="fa fa-tags fa-fw"></i> Keyword(s) : <?php the_tags('', ', '); ?>
                </section>
                <section class="alert alert-warning article-author">
                    <div class="media">
                        <div class="media-left">
                            <?php echo get_avatar(get_the_author_meta('ID'), 96); ?>
                        </div>
                        <div class="media-body">
                            <h4>
                                <?php echo the_author_posts_link(); ?>
                                <small>
                                    <?php $user_id = get_the_author_meta('ID');
                                    $user_obj = get_userdata($user_id);
                                    if (!empty($user_obj->roles)) {
                                        foreach ($user_obj->roles as $role) {
                                            echo '(' . $role . ')';
                                        }
                                    } ?>
                                </small>
                                <ul class="pull-right">
                                    <?php $fields = array(
                                        'url' => array('icon' => 'home', 'label' => __('Website', 'students')),
                                        'facebook' => array('icon' => 'facebook-square', 'label' => __('Facebook', 'students')),
                                        'twitter' => array('icon' => 'twitter', 'label' => __('Twitter', 'students')),
                                        'instagram' => array('icon' => 'instagram', 'label' => __('Instagram', 'students')),
                                        'googleplus' => array('icon' => 'google-plus-square', 'label' => __('Google+', 'students')),
                                        'github' => array('icon' => 'github', 'label' => __('Github', 'students')),
                                    );
                                    foreach ($fields as $meta => $data) :
                                        if (!get_the_author_meta($meta)) {
                                            continue;
                                        }
                                        $type = $data['icon']; ?>
                                        <li>
                                            <a href="<?php echo esc_url(get_the_author_meta($meta)); ?>" class="icon fa fa-<?php echo esc_attr($type); ?>" title="<?php echo esc_attr($data['label']); ?>"></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </h4>
                            <p><?php echo get_the_author_meta('description'); ?></p>
                        </div>
                    </div>
                </section>
                <?php if (comments_open() || get_comments_number()) :
                    comments_template();
                endif; ?>
            <?php endwhile; ?>

            <div class="nav-previous alignleft"><?php next_posts_link('Older posts'); ?></div>
            <div class="nav-next alignright"><?php previous_posts_link('Newer posts'); ?></div>

        <?php else : ?>
            <p><?php __('Halaman tidak tersedia.', 'students'); ?></p>
        <?php endif; ?>
    </div>
    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>