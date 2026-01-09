<?php
get_header();
?>
<div class="tp-page-area pt-120 pb-80">
    <div class="container container-1424">
        <div class="tp-page-wrapper mr-85 mb-40">
            <?php if (have_posts()): while (have_posts()): the_post(); ?>
                    <?php echo get_template_part('templates/content', 'page') ?>
                <?php endwhile; ?>
            <?php else: ?>
                <p>Page Post not found</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php get_footer();
