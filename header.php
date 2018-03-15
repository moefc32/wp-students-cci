<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="shortcut icon" href="<?php echo esc_url(get_template_directory_uri()) ?>/res/image/favicon.png">

	<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet">
	<?php if (is_singular()) wp_enqueue_script('comment-reply');
	wp_head();
	?>
</head>

<body <?php body_class(); ?>>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo get_home_url(); ?>">
					<img class="logo hidden-xs" alt="Logo" src="<?php echo esc_url(get_template_directory_uri()) ?>/res/image/banner.png">
					<img class="logo visible-xs-block" alt="Logo" src="<?php echo esc_url(get_template_directory_uri()) ?>/res/image/banner_mini.png">
				</a>
			</div>
			<div id="main-navbar" class="collapse navbar-collapse">
				<?php wp_nav_menu(array('fallback_cb' => false, 'theme_location' => 'primary', 'depth' => 2, 'container' => false, 'menu_class' => 'nav navbar-nav visible-xs-block', 'walker' => new wp_bootstrap_navwalker()));
				if (!is_user_logged_in()) { ?>
				<div class="navbar-form navbar-right">
					<a href="<?php echo get_site_url(); ?>/wp-login.php" class="btn btn-danger"><i class="fa fa-lock"> Login</i></a>
				</div>
				<?php } ?>
				<form method="get" id="search_form" action="<?php echo get_home_url(); ?>" class="navbar-form navbar-right" role="search">
					<div class="input-group">
						<input type="text" class="form-control" name="s" placeholder="Cari..." value="<?php printf(__('%s', 'students'), get_search_query()); ?>">
						<span class="input-group-btn">
							<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
						</span>
					</div>
				</form>
			</div>
		</div>
	</nav>