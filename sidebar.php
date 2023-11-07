	<aside class="col-sm-4">
	    <?php if (is_active_sidebar('sidebar-ads-widget')) { ?>
	        <section class="row">
	            <div class="col-sm-12 text-center">
	                <?php dynamic_sidebar('sidebar-ads-widget'); ?>
	            </div>
	        </section>
	    <?php } else { ?>
	        <section class="row">
	            <div class="col-sm-12 text-center ads hidden-xs">
	                <img alt="ads" src="<?php echo esc_url(get_template_directory_uri()) ?>/res/image/ads.jpg">
	            </div>
	        </section>
	    <?php }
        if (is_active_sidebar('sidebar-widget')) { ?>
	        <section class="row">
	            <div class="col-sm-12 text-center">
	                <?php dynamic_sidebar('sidebar-widget'); ?>
	            </div>
	        </section>
	    <?php } ?>
	</aside>