<?php
if (!defined('ABSPATH')) exit;

class Theme_Gallery_Metabox
{

    private $meta_key = '_theme_gallery_images';

    public function __construct()
    {
        add_action('add_meta_boxes', [$this, 'add_metabox']);
        add_action('save_post', [$this, 'save_metabox']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_assets']);
    }

    // Add Meta Box
    public function add_metabox()
    {
        global $post;
        if ($post && get_post_format($post->ID) === 'gallery') {
            add_meta_box(
                'theme_gallery_metabox',
                __('Gallery Repeater', 'theme'),
                [$this, 'render_metabox'],
                'post',   // can change to page or custom post type
                'normal',
                'default',
                ['__back_compat_meta_box' => true]
            );
        }
    }

    // Meta Box UI
    public function render_metabox($post)
    {
        wp_nonce_field('theme_gallery_nonce_action', 'theme_gallery_nonce');

        $images = get_post_meta($post->ID, $this->meta_key, true);
        if (!is_array($images)) $images = [];
?>

        <div id="theme-gallery-wrapper" class="theme-gallery-metabox-wrapper">
            <button type="button" class="button theme-add-image">
                + Add Image
            </button>

            <ul id="theme-sortable-list">
                <?php foreach ($images as $img_id): ?>
                    <li class="theme-item" data-id="<?php echo esc_attr($img_id); ?>">
                        <img src="<?php echo esc_url(wp_get_attachment_thumb_url($img_id)); ?>">
                        <span class="theme-remove">&times;</span>
                    </li>
                <?php endforeach; ?>
            </ul>

            <input type="hidden"
                id="theme-image-ids"
                name="theme_gallery_ids"
                value="<?php echo esc_attr(implode(',', $images)); ?>">

        </div>

        <style>
            #theme-sortable-list {
                margin-top: 10px;
                display: flex;
                gap: 10px;
                flex-wrap: wrap;
            }

            #theme-sortable-list .theme-item {
                width: 100px;
                height: 100px;
                border: 1px solid #ddd;
                position: relative;
                overflow: hidden;
            }

            #theme-sortable-list img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .theme-remove {
                position: absolute;
                top: 4px;
                right: 4px;
                background: #d32f2f;
                color: #fff;
                padding: 0 5px;
                font-size: 16px;
                cursor: pointer;
            }
        </style>

<?php
    }

    // Save Meta Data
    public function save_metabox($post_id)
    {
        if (
            !isset($_POST['theme_gallery_nonce']) ||
            !wp_verify_nonce($_POST['theme_gallery_nonce'], 'theme_gallery_nonce_action')
        ) return;

        if (isset($_POST['theme_gallery_ids'])) {
            $ids = sanitize_text_field($_POST['theme_gallery_ids']);
            $ids = array_filter(explode(',', $ids));
            update_post_meta($post_id, $this->meta_key, $ids);
        }
    }

    // Load Scripts
    public function enqueue_assets($hook)
    {
        if ($hook === 'post.php' || $hook === 'post-new.php') {

            wp_enqueue_media();
            wp_enqueue_script('jquery-ui-sortable');

            wp_register_script(
                'theme-gallery-js',
                get_template_directory_uri() . '/inc/gallery-metabox/gallery-admin.js',
                ['jquery'],
                '1.0',
                true
            );

            wp_enqueue_script('theme-gallery-js');
        }
    }
}
