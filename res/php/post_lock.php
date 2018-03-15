<?php
add_action('transition_post_status', 'students_guard', 10, 3);
function students_guard($new_status, $old_status, $post) {
	if ($new_status === 'publish' 
		&& !students_should_let_post_publish($post)) {
		wp_die(__('Tidak dapat memposting, silahkan tambahkan featured image terlebih dahulu.', 'students'));
	}
}

register_activation_hook(__FILE__, 'students_set_default_on_activation');
function students_set_default_on_activation() {
	add_option('students_post_types', array('post'));
	add_option('students_enforcement_start', time());
}

add_action('plugins_loaded', 'students_textdomain_init');
function students_textdomain_init() {
	load_plugin_textdomain(
		'students', 
		false, 
		dirname(plugin_basename(__FILE__)).'/lang' 
	); 
}

add_action('admin_enqueue_scripts', 'students_enqueue_edit_screen_js');
function students_enqueue_edit_screen_js($hook) {
	global $post;
	if ($hook !== 'post.php' && $hook !== 'post-new.php')
		return;
	if (in_array($post->post_type, students_return_post_types())) {
		
		wp_register_script('post-lock', get_template_directory_uri() . '/res/js/post_lock.js', array('jquery'));
        wp_enqueue_script('post-lock');
		wp_localize_script(
			'post-lock',
			'objectL10n',
			array(
				'jsWarningHtml' => __('<strong>Featured image belum dipilih</strong>, silahkan tambahkan featured image.', 'students'),
			)
		);
	}
}

function students_return_post_types() {
	$option = get_option('students_post_types', 'default');
	if ($option === 'default') {
		$option = array('post');
		add_option('students_post_types', $option);
	} 
	elseif ($option === '') {
		$option = array();
	}
	return apply_filters('students_post_types', $option);
}

function students_enforcement_start_time() {
	$option = get_option('students_enforcement_start', 'default');
	if ($option === 'default') {
		$existing_install_guessed_time = time() - (86400*14);
		add_option('students_enforcement_start', $existing_install_guessed_time);
		$option = $existing_install_guessed_time;
	}
	return apply_filters('students_enforcement_start', (int)$option);
}

function students_should_let_post_publish($post) {
	$has_featured_image = has_post_thumbnail($post->ID);
	$is_watched_post_type = in_array($post->post_type, students_return_post_types());
	$is_after_enforcement_time = strtotime($post->post_date) > students_enforcement_start_time();
	if ($is_after_enforcement_time && $is_watched_post_type) {
		return $has_featured_image;
	}
	return true;
}
