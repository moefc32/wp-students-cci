<?php
add_action('widgets_init', 'students_recent_posts');

function students_recent_posts() {
	register_widget('students_recent_posts_widget');
}

class students_recent_posts_widget extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'students_recent_posts_widget',
			__('Berita Terbaru', 'students'),
			array(
				'classname'   => 'students_recent_posts_widget widget_recent_entries',
				'description' => __('Menampilkan berita terbaru berdasarkan kategori.', 'students')
			)
		);
	}

	function form($instance) {
		$defaults  = array(
			'title'			=> '',
			'category'		=> '',
			'number'		=> 3,
			'show_featured'	=> '',
			'show_excerpt'	=> ''
		);
		$instance  = wp_parse_args((array) $instance, $defaults);
		$title     = $instance['title'];
		$category  = $instance['category'];
		$number    = $instance['number'];
		$show_featured = $instance['show_featured'];
		$show_excerpt = $instance['show_excerpt'];
?>
		<p>
			<label for="students_recent_posts_widget_title">Judul :</label>
			<input type="text" class="widefat" id="students_recent_posts_widget_title" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="students_recent_posts_widget_category">Kategori :</label>
			<?php wp_dropdown_categories(array(
				'orderby'    => 'title',
				'hide_empty' => false,
				'name'       => $this->get_field_name('category'),
				'id'         => 'students_recent_posts_widget_category',
				'class'      => 'widefat',
				'selected'   => $category
			)); ?>
		</p>
		<p>
			<label for="students_recent_posts_widget_number">Artikel yang ditampilkan :</label>
			<input type="text" id="students_recent_posts_widget_number" name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo esc_attr($number); ?>" size="3" />
		</p>
		<p>
			<input type="checkbox" id="students_recent_posts_widget_show_featured" class="checkbox" name="<?php echo $this->get_field_name('show_featured'); ?>" <?php checked($show_featured, 1); ?> />
			<label for="students_recent_posts_widget_show_featured">Tampilkan featured image kecil</label>
		</p>
		<p>
			<input type="checkbox" id="students_recent_posts_widget_show_date" class="checkbox" name="<?php echo $this->get_field_name('show_excerpt'); ?>" <?php checked($show_excerpt, 1); ?> />
			<label for="students_recent_posts_widget_show_date">Tampilkan excerpt</label>
		</p>
<?php }

	function update($new_instance, $old_instance) {
		$instance              = $old_instance;
		$instance['title']     = wp_strip_all_tags($new_instance['title']);
		$instance['category']  = wp_strip_all_tags($new_instance['category']);
		$instance['number']    = is_numeric($new_instance['number']) ? intval($new_instance['number']) : 3;
		$instance['show_featured'] = isset($new_instance['show_featured']) ? 1 : 0;
		$instance['show_excerpt'] = isset($new_instance['show_excerpt']) ? 1 : 0;
		return $instance;
	}
	
	function widget($args, $instance) {
		extract($args);
		echo $before_widget;
		$title     = apply_filters('widget_title', $instance['title'], $instance, $this->id_base);
		$category  = $instance['category'];
		$number    = $instance['number'];
		$show_featured = ($instance['show_featured'] === 1) ? true : false;
		$show_excerpt = ($instance['show_excerpt'] === 1) ? true : false;
		$posts = null;

		if (!empty($title)) echo $before_title . $title . $after_title;
		$cat_recent_posts = new WP_Query(array(
			'post_type'      => 'post',
			'posts_per_page' => $number,
			'cat'            => $category
		));

		if ($cat_recent_posts->have_posts()) {
			$post = $posts[0]; $c=0;
			echo '<ul class="category-posts">';
			while ($cat_recent_posts->have_posts()) : the_post();
				$cat_recent_posts->the_post();
				$c++;
				if($c == 1) :
					echo '<li>';
					echo '<a href="' . get_permalink() . '" title="' . get_the_title() . '">';
					echo '	<section class="article-featured">';
								if (has_post_thumbnail()) {
									the_post_thumbnail('main-full featured-image', array('title' => strip_tags(get_the_title()), 'itemprop' => 'image'));
								}
					echo '	</section>';
					echo '</a>';
					echo '<div class="post-date round-bottom">';
					echo '	<i class="fa fa-calendar fa-fw"></i> ' . get_the_time(get_option('date_format')); ?>
							<span class="comment-number pull-right">
								<i class="fa fa-comments fa-fw"></i> <?php comments_number('0', '1', '%'); ?>
							</span>
					<?php echo '</div>';
					echo '<section class="article-title">';
					echo '	<a href="' . get_permalink() . '">' . get_the_title() . '</a>';
					echo '</section>';
					if ($show_featured) {
						if ($show_excerpt) echo the_excerpt();
					}
					echo '</li>';
				else :
					if ($show_featured) {
						echo '<li class="sub">';
						echo '<div class="media">';
						echo '<div class="media-left">';
						echo '<a href="' . get_permalink() . '" title="' . get_the_title() . '">';
								if (has_post_thumbnail()) {
									the_post_thumbnail(array(64, 64));
								}
						echo '</a>';
						echo '</div>';
						echo '<div class="media-body">';
						echo '<section class="article-title">';
						echo '	<a href="' . get_permalink() . '">' . get_the_title() . '</a>';
						echo '</section>';
						echo '<div class="sub-date">' . get_the_time(get_option('date_format')); ?>
								<span class="comment-number pull-right">
									<i class="fa fa-comments fa-fw"></i> <?php comments_number('0', '1', '%'); ?>
								</span>
						<?php echo '</div>';
						echo '</div>';
						echo '</div>';
						echo '</li>';
					} else {
						echo '<li class="sub">';
						echo '<div class="sub-date">' . get_the_time(get_option('date_format')); ?>
								<span class="comment-number pull-right">
									<i class="fa fa-comments fa-fw"></i> <?php comments_number('0', '1', '%'); ?>
								</span>
						<?php echo '</div>';
						echo '<section class="article-title">';
						echo '	<a href="' . get_permalink() . '">' . get_the_title() . '</a>';
						echo '</section>';
						echo '</li>';
					}
				endif;
			endwhile;
			echo '</ul>';
			wp_reset_postdata();
		} else {
			__('Belum ada artikel.', 'students');
		}
		echo $after_widget;
	}
}
