<?php
if (!defined('ABSPATH')) {
    exit;
}

class Theme_Audio_Metabox
{

    private $meta_key = '_theme_audio_embed';
    private $nonce_key = 'theme_audio_nonce';
    private $metabox_id = 'theme_audio_metabox';

    public function __construct()
    {
        add_action('add_meta_boxes', [$this, 'add_metabox']);
        add_action('save_post', [$this, 'save_metabox']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_assets']);
    }

    public function add_metabox()
    {
        add_meta_box(
            $this->metabox_id,
            __('Audio Embed (SoundCloud / Embed iframe)', 'theme'),
            [$this, 'render_metabox'],
            'post',
            'normal',
            'default'
        );
    }

    public function render_metabox($post)
    {
        wp_nonce_field($this->nonce_key . '_action', $this->nonce_key);

        $value = get_post_meta($post->ID, $this->meta_key, true);
        // wrapper needs ID/class used by JS to toggle visibility
        echo '<div id="theme-audio-metabox-wrapper" class="theme-audio-metabox-wrapper" style="display:none;">';

        echo '<p>';
        echo '<label for="theme_audio_embed">' . esc_html__('Paste full embed code (iframe) or SoundCloud url here:', 'theme') . '</label>';
        echo '</p>';

        echo '<textarea id="theme_audio_embed" name="theme_audio_embed" rows="6" style="width:100%;">' . esc_textarea($value) . '</textarea>';

        echo '<p class="description">' . esc_html__('You can paste SoundCloud iframe or any oEmbed/embed code. This will be sanitized and saved.', 'theme') . '</p>';

        echo '</div>'; // wrapper
    }

    public function save_metabox($post_id)
    {
        // autosave, revision checks
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (wp_is_post_revision($post_id) || wp_is_post_autosave($post_id)) return;

        if (!isset($_POST[$this->nonce_key]) || !wp_verify_nonce($_POST[$this->nonce_key], $this->nonce_key . '_action')) {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        if (isset($_POST['theme_audio_embed'])) {
            $raw = wp_unslash($_POST['theme_audio_embed']);

            // Allow safe post HTML + iframe with specific attributes
            $allowed = wp_kses_allowed_html('post');

            // Ensure iframe allowed with common attributes
            $allowed['iframe'] = [
                'src' => true,
                'width' => true,
                'height' => true,
                'frameborder' => true,
                'allow' => true,
                'allowfullscreen' => true,
                'scrolling' => true,
                'style' => true,
                'class' => true,
                'id' => true,
                'aria-hidden' => true,
            ];

            // Also allow <a> tag attributes (in case user paste link)
            if (! isset($allowed['a'])) {
                $allowed['a'] = [
                    'href' => true,
                    'title' => true,
                    'target' => true,
                    'rel' => true,
                ];
            }

            $clean = wp_kses($raw, $allowed);
            update_post_meta($post_id, $this->meta_key, $clean);
        } else {
            // If empty, delete meta
            delete_post_meta($post_id, $this->meta_key);
        }
    }

    public function enqueue_assets($hook)
    {
        // only load on post editor screens
        if (! in_array($hook, ['post.php', 'post-new.php'], true)) {
            return;
        }

        // Register and enqueue our admin JS
        wp_register_script(
            'theme-audio-admin-js',
            get_template_directory_uri() . '/inc/audio-metabox/audio-metabox.js',
            ['jquery'],
            '1.0',
            true
        );

        wp_enqueue_script('theme-audio-admin-js');

        // Localize some data for JS if needed
        $data = [
            'metaboxWrapper' => '#theme-audio-metabox-wrapper',
            'metaboxId' => $this->metabox_id,
        ];
        // wp_localize_script('theme-audio-admin-js', 'ThemeAudioAdmin', $data);
    }

    // Helper for frontend: can be used in theme templates
    public static function get_audio_embed($post_id = null)
    {
        if (!$post_id) $post_id = get_the_ID();
        return get_post_meta($post_id, '_theme_audio_embed', true);
    }
} // end class

// initialize
new Theme_Audio_Metabox();
