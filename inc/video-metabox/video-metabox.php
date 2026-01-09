<?php

class VideoMetaBox
{

    public function __construct()
    {
        add_action('add_meta_boxes', [$this, 'register_video_metabox']);
        add_action('save_post', [$this, 'save_video']);
        add_action('admin_enqueue_scripts', [$this, 'admin_scripts']);
    }

    public function register_video_metabox()
    {
        add_meta_box(
            'video_metabox',
            'Video Upload',
            [$this, 'metabox_html'],
            'post',
            'normal',
            'default'
        );
    }

    public function metabox_html($post)
    {
        $video_url = get_post_meta($post->ID, '_video_url', true);
?>

        <div id="video_url_field">
            <label for="video_url"><strong>Video URL</strong> (YouTube, Vimeo, MP4)</label>
            <input type="text"
                id="video_url"
                name="video_url"
                value="<?php echo esc_attr($video_url); ?>"
                style="width:100%; margin-top:10px; padding:8px;">
        </div>

<?php
    }

    public function save_video($post_id)
    {
        if (isset($_POST['video_url'])) {
            update_post_meta($post_id, '_video_url', esc_url_raw($_POST['video_url']));
        }
    }


    public function admin_scripts($hook)
    {
        if ($hook === 'post.php' || $hook === 'post-new.php') {
            wp_enqueue_media();
            wp_enqueue_script(
                'video-metabox-js',
                get_template_directory_uri() . '/inc/video-metabox/video-metabox.js',
                ['jquery'],
                false,
                true
            );
        }
    }
}

new VideoMetaBox();
