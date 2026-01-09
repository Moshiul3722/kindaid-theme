<?php
$audio_embed = Theme_Audio_Metabox::get_audio_embed();
if (is_single()):
    echo get_template_part('templates/blog/blog-details');
else: ?>
    <article class="tp-postbox-item mb-30">
        <div class="tp-postbox-thumb ratio ratio-16x9 mb-30">
            <?php the_post_thumbnail(); ?>

            <?php
            if ($audio_embed) {
                // echo '<div class="post-audio-embed">';
                // If saved value is just a plain URL (not iframe), try to oembed it:
                if (false === strpos($audio_embed, '<iframe') && filter_var($audio_embed, FILTER_VALIDATE_URL)) {
                    // try wp_oembed_get for URL like SoundCloud track/url or YouTube
                    $oembed = wp_oembed_get($audio_embed);
                    if ($oembed) {
                        echo $oembed;
                    } else {
                        // fallback: print as link
                        echo '<a href="' . esc_url($audio_embed) . '" target="_blank" rel="noopener noreferrer">' . esc_html__('Listen', 'theme') . '</a>';
                    }
                } else {
                    // saved HTML (iframe) — print as-is (already sanitized on save)
                    echo $audio_embed;
                }
                // echo '</div>';
            }
            ?>

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