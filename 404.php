<?php get_header();
get_template_part('res/php/navigator'); ?>

<div class="container">
    <div class="col-sm-8">
        <div class="alert alert-danger">
            <div class="media">
                <div class="media-left">
                    <img src="<?php echo esc_url(get_template_directory_uri()) ?>/res/image/oops.png">
                </div>
                <div class="media-body">
                    <h3>Error 404 <small>(page not found)</small></h3>
                    <p>Halaman tidak tersedia, silakan coba kembali.</p>
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
        </div>
    </div>
    <?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>