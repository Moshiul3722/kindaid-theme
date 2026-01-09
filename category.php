<?php

/**
 * Main template file.
 * 
 * @package KindAid
 */

?>

<?php get_header() ?>

<h2>This is Cagetory page</h2>
<!-- tp-blog-sidebar-area-start -->
<div class="tp-blog-post-area pt-120 pb-80">
    <div class="container container-1424">
        <div class="row justify-content-center">
            <div class="col-xl-9 col-lg-8">
                <div class="tp-postbox-wrapper mr-85 mb-40">
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                            <?php echo get_template_part('templates/content', get_post_format()) ?>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
                    <?php
                    endif; ?>

                    <div class="tp-pagination mt-40">
                        <?php kindaid_blog_pagination(); ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- tp-blog-sidebar-area-end -->
<?php get_footer(); ?>