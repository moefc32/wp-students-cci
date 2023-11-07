<?php get_header();
get_template_part('res/php/navigator'); ?>

<div class="container">
    <div class="col-sm-8">
        <section class="alert alert-warning article-author">
            <div class="media">
                <div class="media-left">
                    <?php
                    $user_id = get_query_var('author');
                    $author_name = get_the_author_meta('display_name', $user_id);
                    $author_desc = get_the_author_meta('description', $user_id);
                    echo get_avatar($user_id, 96);
                    ?>
                </div>
                <div class="media-body">
                    <h4>
                        <?php
                        if ($author_name !== null)
                            echo $author_name;
                        ?>
                        <small>
                            <?php
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
                                if (!get_the_author_meta($meta, $user_id)) {
                                    continue;
                                }
                                $type = $data['icon']; ?>
                                <li>
                                    <a href="<?php echo esc_url(get_the_author_meta($meta, $user_id)); ?>" class="icon fa fa-<?php echo esc_attr($type); ?>" title="<?php echo esc_attr($data['label']); ?>"></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </h4>
                    <p><?php
                        if ($author_desc !== null)
                            echo $author_desc;
                        ?></p>
                </div>
            </div>
        </section>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="media">
                    <div class="media-left">
                        <?php if (has_post_thumbnail()) { ?>
                            <div class="img-thumbnail">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                    <?php the_post_thumbnail(array(128, 128)); ?>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="media-body article-list">
                        <section class="article-title">
                            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
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
            <?php endwhile; ?>
            <?php if (function_exists("wp_bs_pagination")) {
                wp_bs_pagination();
            } ?>
        <?php else : ?>
            <p><?php __('Belum ada artikel.', 'students'); ?></p>
        <?php endif; ?>
    </div>
    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>