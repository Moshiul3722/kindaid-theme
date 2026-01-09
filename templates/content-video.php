<?php
$video = get_post_meta(get_the_ID(), '_video_url', true);
$overlay = $video ? 'tp-postbox-thumb-overlay' : '';
if (is_single()):
    echo get_template_part('templates/blog/blog-details');
else: ?>
    <article class="tp-postbox-item mb-30">
        <div class="tp-postbox-thumb <?php echo esc_attr($overlay); ?> mb-30">
            <?php the_post_thumbnail(); ?>

            <?php if ($video) :  ?>
                <!-- Videos template code goes here -->
                <div class="tp-postbox-video">
                    <a class="popup-video" href="<?php echo esc_url($video) ?>">
                        <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4.24635e-08 1.80425C2.3978e-08 1.01881 0.863951 0.539969 1.53 0.956249L14.6432 9.152C15.2699 9.54367 15.2699 10.4563 14.6432 10.848L1.53 19.0438C0.863949 19.46 4.46728e-07 18.9812 4.28243e-07 18.1958L4.24635e-08 1.80425Z" fill="#0E0F11" />
                        </svg>
                    </a>
                </div>
            <?php endif; ?>
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