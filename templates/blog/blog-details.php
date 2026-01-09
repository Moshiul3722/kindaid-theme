<?php
$author_id = get_the_author_meta('ID');
$bio = Post_Biography_Meta_Box::get();
?>


<article id="post-<?php the_ID(); ?>" <?php post_class("tp-postbox-item mb-30") ?>>
    <?php if (has_post_thumbnail()) :  ?>
        <div class="tp-postbox-thumb mb-30">
            <?php the_post_thumbnail(); ?>
        </div>
    <?php endif; ?>
    <div class="tp-postbox-content">
        <?php echo get_template_part('templates/blog/blog-category'); ?>
        <h2 class="tp-postbox-title mb-15"><?php the_title(); ?></h2>
        <?php echo get_template_part('templates/blog/blog-meta'); ?>

        <div class="tp-postbox-content-wrapper">
            <?php the_content(); ?>
        </div>
    </div>
</article>

<div class="tp-blog-tag-social">
    <div class="row">
        <div class="col-xl-8">
            <div class="tp-blog-tag mb-20">
                <?php
                $tags = get_the_tags();
                if ($tags) { ?>
                    <h4 class="tp-blog-tag-title mb-0 mr-10">Popular Tags:</h4>
                    <?php
                    foreach ($tags as $tag) {
                    ?>
                        <a href="<?php echo esc_url(get_tag_link($tag->term_id)) ?>"><?php echo esc_html($tag->name) ?></a>
                <?php
                    }
                }
                ?>
            </div>
        </div>
        <?php echo get_template_part('templates/blog/blog-share-url'); ?>
    </div>
</div>

<?php
$prev_post = get_previous_post();
$next_post = get_next_post();
?>

<div class="tp-blog-navigation-wrap mb-35 mt-70">
    <div class="row justify-content-between">
        <div class="col-xl-5 col-lg-6 col-md-6">
            <?php if ($prev_post): ?>
                <div class="tp-blog-navigation mb-30">
                    <a href="<?php echo get_permalink($prev_post->ID); ?>">
                        <i class="far fa-arrow-left"></i>
                        <div class="tp-blog-navigation-text">
                            <span>Previous Post</span>
                            <h4 class="tp-blog-navigation-title"><?php echo esc_html($prev_post->post_title); ?></h4>
                        </div>
                    </a>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-xl-5 col-lg-6 col-md-6">
            <?php if ($next_post): ?>
                <div class="tp-blog-navigation mb-30 text-end">
                    <a href="<?php echo get_permalink($next_post->ID); ?>">
                        <div class="tp-blog-navigation-text">
                            <span>Next Post</span>
                            <h4 class="tp-blog-navigation-title"><?php echo esc_html($next_post->post_title); ?></h4>
                        </div>
                        <i class="far fa-arrow-right"></i>
                    </a>
                </div>
            <?php endif; ?>
        </div>

        <div class="tp-postbox-biography mt-40">
            <div class="d-flex align-items-start">
                <div class="tp-postbox-biography-img">
                    <?php print get_avatar(get_the_author_meta('user_email'), '100', '', '', ['class' => 'media-object img-circle']) ?>
                </div>
                <div class="tp-postbox-biography-content">
                    <div class="sidebar-widget-author-content">
                        <span><?php echo esc_html(get_the_author_meta('description', $author_id)); ?></span>
                        <h4 class="tp-postbox-biography-name"><?php echo esc_html(get_the_author()); ?></h4>
                        <?php
                        if ($bio) {
                            echo '<p>';
                            echo wpautop(esc_html($bio));
                            echo '</p>';
                        }
                        ?>

                    </div>

                    <?php
                    $items = get_user_meta(get_current_user_id(), 'current_user_repeater_text', true);

                    if (is_array($items)) {
                    ?>
                        <div class="tp-postbox-biography-social">
                            <?php
                            foreach ($items as $item) {
                            ?>
                                <a href="<?php echo esc_html($item["url"]) ?>">
                                    <i class="<?php echo esc_html($item["icon"]) ?>"></i>
                                </a>
                            <?php
                            } ?>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (comments_open() || get_comments_number()) :
    comments_template();
endif; ?>