<?php get_header(); ?>

<div class="jumbotron">
    <div class="container">
        <div class="col-sm-8">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $c = 0;
                    $class = '';
                    $args = array('posts_per_page' => 5);
                    $myposts = get_posts($args);
                    foreach ($myposts as $post) : setup_postdata($post);
                        $c++;
                        $class = ($c == 1) ? 'active' : '';
                    ?>
                        <div class="item <?php echo $class; ?>">
                            <section class="article-featured">
                                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('main-full featured-image', array('title' => strip_tags(get_the_title()), 'itemprop' => 'image')); ?></a>
                                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </section>
                            <div class="carousel-caption slider-caption">
                                <div class="slider-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </div>
                                <div class="slider-date">
                                    <i class="fa fa-calendar fa-fw"></i> <?php echo get_the_time(get_option('date_format')); ?>
                                    <span class="comment-number pull-right">
                                        <i class="fa fa-comments fa-fw"></i> <?php comments_number('Belum ada komentar', '1 komentar', '% komentar'); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;
                    wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
        <div class="col-sm-4 hidden-xs">
            <ul class="recent">
                <?php global $post;
                $myposts = get_posts('numberposts=2&offset=5&category=');
                foreach ($myposts as $post) :
                    setup_postdata($post);
                    echo '<li><a href="' . get_permalink() . '" title="' . get_the_title() . '">';
                    echo '<section class="article-featured">';
                    if (has_post_thumbnail()) {
                        the_post_thumbnail('main-full featured-image', array('title' => strip_tags(get_the_title()), 'itemprop' => 'image'));
                    }
                    echo '</section></a><div class="post-recent round-bottom">';
                    echo '	<a href="' . get_permalink() . '">' . get_the_title() . '</a>';
                    echo '<span class="comment-number pull-right">';
                    echo '<i class="fa fa-comments fa-fw"></i>' . comments_number('0', '1', '%');
                    echo '</span></div></li>';
                endforeach; ?>
            </ul>
        </div>
    </div>
</div>

<?php get_template_part('res/php/navigator'); ?>

<div class="container">
    <div class="col-sm-8">
        <div class="row">
            <?php if (is_active_sidebar('cat-feed-1')) {
                dynamic_sidebar('cat-feed-1');
            }
            if (is_active_sidebar('cat-feed-2')) {
                dynamic_sidebar('cat-feed-2');
            } ?>
        </div>
        <hr />
        <div class="row">
            <div class="col-sm-12 text-center">
                <?php if (is_active_sidebar('middle-banner-widget')) {
                    dynamic_sidebar('middle-banner-widget');
                } else { ?>
                    <h3><i class="fa fa-quote-right fa-fw"></i> Connect, Share, Speak Up!</h3>
                <?php } ?>
            </div>
        </div>
        <hr />
        <div class="row">
            <?php if (is_active_sidebar('cat-feed-3')) {
                dynamic_sidebar('cat-feed-3');
            }
            if (is_active_sidebar('cat-feed-4')) {
                dynamic_sidebar('cat-feed-4');
            } ?>
        </div>
        <hr />
        <div class="row">
            <?php if (is_active_sidebar('cat-feed-5')) {
                dynamic_sidebar('cat-feed-5');
            }
            if (is_active_sidebar('cat-feed-6')) {
                dynamic_sidebar('cat-feed-6');
            }
            if (is_active_sidebar('cat-feed-7')) {
                dynamic_sidebar('cat-feed-7');
            } ?>
        </div>
    </div>
    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>