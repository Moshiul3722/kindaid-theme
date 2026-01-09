<?php
$gallery = get_post_meta(get_the_ID(), '_theme_gallery_images', true);
if (is_single()):
    echo get_template_part('templates/blog/blog-details');
else: ?>
    <article class="tp-postbox-item mb-30">
        <div class="tp-postbox-thumb mb-30">
            <div class="swiper-container tp-postbox-gallery-active">
                <div class="swiper-wrapper">
                    <?php
                    if ($gallery) {
                        foreach ($gallery as $id) {
                    ?>
                            <div class="swiper-slide">
                                <div class="tp-postbox-thumb-overlay">
                                    <img src="<?php echo esc_url(wp_get_attachment_image_url($id, 'large')) ?>" alt="">
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="tp-blog-gallery-arrow">
                <button class="tp-gallery-arrow-prev tp-gallery-arrow">
                    <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14" fill="none">
                        <path d="M7 13L1 7L7 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <button class="tp-gallery-arrow-next tp-gallery-arrow ml-5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" viewBox="0 0 8 14" fill="none">
                        <path d="M1 13L7 7L1 1" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </div>
            <?php echo get_template_part('templates/blog/blog-category'); ?>
        </div>
        <div class="tp-postbox-content">
            <?php echo get_template_part('templates/blog/blog-meta'); ?>
            <h2 class="tp-postbox-title mb-15"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php the_content() ?>
            <?php echo get_template_part('templates/blog/blog-btn'); ?>
        </div>
    </article>
<?php endif; ?>