<?php
if (! class_exists('Post_Biography_Meta_Box')) {

    class Post_Biography_Meta_Box
    {

        private $meta_key = '_post_biography';
        private $nonce    = 'post_biography_nonce';

        public function __construct()
        {
            add_action('add_meta_boxes', [$this, 'register_meta_box']);
            add_action('save_post', [$this, 'save_meta']);
        }

        /**
         * Register meta box
         */
        public function register_meta_box()
        {
            add_meta_box(
                'post_biography_meta_box',
                __('Post Biography', 'textdomain'),
                [$this, 'render_meta_box'],
                'post',        // ✅ post
                'normal',
                'default'
            );
        }

        /**
         * Render meta box UI
         */
        public function render_meta_box($post)
        {
            wp_nonce_field('save_post_biography', $this->nonce);

            $value = get_post_meta($post->ID, $this->meta_key, true);

            wp_editor(
                esc_textarea($value),
                'post_biography_text',
                [
                    'textarea_name' => 'post_biography_text',
                    'media_buttons' => false,
                    'textarea_rows' => 3,
                ]
            );
        }


        /**
         * Save meta value
         */
        public function save_meta($post_id)
        {

            // nonce check
            if (! isset($_POST[$this->nonce]) || ! wp_verify_nonce($_POST[$this->nonce], 'save_post_biography')) {
                return $post_id;
            }

            // autosave check
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
                return;
            }

            // permission check
            if (! current_user_can('edit_post', $post_id)) {
                return;
            }

            // save data
            if (isset($_POST['post_biography_text'])) {
                update_post_meta(
                    $post_id,
                    $this->meta_key,
                    sanitize_textarea_field($_POST['post_biography_text'])
                );
            }
        }

        /**
         * Helper function (optional)
         */
        public static function get($post_id = null)
        {
            $post_id = $post_id ?: get_the_ID();
            return get_post_meta($post_id, '_post_biography', true);
        }
    }

    // Init
    new Post_Biography_Meta_Box();
}
