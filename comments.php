<section class="comments">
    <?php if (is_active_sidebar('comments-widget')) {
        dynamic_sidebar('comments-widget');
    } else {
        if (post_password_required()) {
            echo '<p class="nocomments">Silakan masukkan kata kunci untuk melihat komentar.</p>';
            return;
        }

        if (have_comments()) : ?>
            <h3>Komentar</h3>
            <div class="commentlist">
                <?php
                wp_list_comments('type=comment&callback=students_comment');
                paginate_comments_links();
                ?>
            </div>
        <?php endif;

        if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
            <p><?php __('Komentar ditutup.', 'students'); ?></p>
        <?php endif; ?>

    <?php comment_form();
    } ?>
</section>