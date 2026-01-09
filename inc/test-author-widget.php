<?php
class Author_Widget extends WP_Widget
{

    public function __construct()
    {
        parent::__construct(
            'Author_widget',
            __('WIB Author Widget', 'textdomain'),
            array('description' => __('A widget with header and repeater fields', 'textdomain'))
        );

        add_action('wp_enqueue_scripts', [$this, 'enqueue_front_assets']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_assets']);
    }

    public function enqueue_front_assets()
    {
        wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css', [], '6.5.1');

        // Local CSS
        wp_enqueue_style(
            'author-widget',
            get_template_directory_uri() . '/inc/custom-widgets/assets/css/author-widget.css'
        );
    }


    public function enqueue_admin_assets($hook)
    {
        if ($hook !== 'widgets.php') return;

        wp_enqueue_style(
            'fontawesome-admin',
            'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css',
            [],
            '6.5.1'
        );

        // Local JS
        wp_enqueue_script(
            'author-widget-admin',
            get_template_directory_uri() . '/inc/custom-widgets/assets/js/author-widget-admins.js',
            ['jquery'],
            time(),
            true
        );


        wp_localize_script(
            'author-widget-admin',
            'AuthorWidgets',
            [
                'field_name' => $this->get_field_name('items'),
                'field_id'   => $this->get_field_id('items'),
                'max_items' => 5, // default
            ]
        );

        wp_enqueue_media();
    }

    /**
     * Backend Widget Form
     */

    public function form($instance)
    {

        $header  = ! empty($instance['header']) ? $instance['header'] : '';
        $max_items  = ! empty($instance['max_items']) ? (int)$instance['max_items'] : '';
        $items   = ! empty($instance['items']) ? $instance['items'] : [];
        $author_slug  = ! empty($instance['author_slug']) ? $instance['author_slug'] : '';

        // adding image field
        $image_id  = ! empty($instance['image_id']) ? $instance['image_id'] : '';

        // Input names
        $header_name = $this->get_field_name('header');
        $max_item_name  = $this->get_field_name('max_items');
        $items_name  = $this->get_field_name('items');
        $author_slug_name = $this->get_field_name('author_slug');

        // Input names for image
        $image_url = $image_id ? wp_get_attachment_url($image_id) : '';

?>

        <!-- Author Information -->

        <p>
            <label><strong>Image (200x200):</strong></label><br>

            <img class="widget-image-preview"
                src="<?php echo esc_url($image_url); ?>"
                style="max-width:100%; <?php echo $image_url ? '' : 'display:none;'; ?>">

            <input type="hidden"
                class="widget-image-id"
                name="<?php echo $this->get_field_name('image_id'); ?>"
                value="<?php echo esc_attr($image_id); ?>">

            <button type="button" class="button select-image">
                <?php echo $image_url ? 'Change Image' : 'Select Image'; ?>
            </button>

            <button type="button" class="button remove-image"
                style="<?php echo $image_url ? '' : 'display:none;'; ?>">
                Remove
            </button>

        </p>

        <!-- Header & Max Items -->
        <div style="display: flex; margin-bottom:7px">
            <div style="flex: 2;">
                <label for="<?php echo esc_attr($header_name); ?>" style="margin-bottom: 5px;"><?php _e('Author Name:', 'kindaid'); ?></label>
                <input class="widefat" type="text" name="<?php echo esc_attr($header_name); ?>" value="<?php echo esc_attr($header); ?>" placeholder="Author Name">
            </div>
            <div style="flex: 2; margin-left:7px;">
                <label for="<?php echo esc_attr($author_slug_name); ?>" style="margin-bottom: 5px;"><?php _e('Author Slug:', 'kindaid'); ?></label>
                <input class="widefat" type="text" name="<?php echo esc_attr($author_slug_name); ?>" value="<?php echo esc_attr($author_slug); ?>" placeholder="Author Slug">
            </div>
            <div style="flex: 1; margin-left: 7px">
                <label style="margin-bottom: 5px;"><?php _e('Max Item:', 'kindaid'); ?></label>
                <input class="widefat max-item-input" type="number" name="<?php echo esc_attr($max_item_name); ?>" value="<?php echo esc_attr($max_items); ?>">
            </div>
        </div>
        <hr>

        <!-- Repeater Items -->
        <div class="repeater-wrapper" data-max-items="<?php echo esc_attr($max_items); ?>" data-field-name="<?php echo esc_attr($this->get_field_name('items')); ?>">
            <!-- Repeater-Items html -->
            <div class="repeater-items">

            </div>

            <button type="button" class="button add-item" style="margin-bottom: 5px;">Add Item</button>

            <p class="limit-message" style="display:none; color:#D34E4E; border: 1px solid; border-radius: 4px; padding:2px 5px 2px 5px; background: #FCF5EE">Maximum limit reached</p>

        </div>

        <script>
            // Style and Script from exlernal files
        </script>

    <?php
    }



    /**
     * Saving Widget Values
     */
    public function update($new_instance, $old_instance)
    {
        $instance = array();

        // Header field save
        $instance['header'] = (!empty($new_instance['header'])) ? sanitize_text_field($new_instance['header']) : '';
        $instance['max_items'] = (!empty($new_instance['max_items'])) ? sanitize_text_field($new_instance['max_items']) : '';
        $instance['image_id'] = ! empty($new_instance['image_id']) ? absint($new_instance['image_id']) : '';
        $instance['author_slug'] = (!empty($new_instance['author_slug'])) ? sanitize_text_field($new_instance['author_slug']) : '';

        // Items array save
        if (!empty($new_instance['items'])) {
            $instance['items'] = array();

            foreach ($new_instance['items'] as $item) {

                if (empty($item['title']) && empty($item['subtitle'])) {
                    continue;
                }

                // Sanitize each field
                $instance['items'][] = [
                    'title'    => sanitize_text_field($item['title'] ?? ''),
                    'subtitle' => sanitize_text_field($item['subtitle'] ?? ''),
                ];
            }

            // If you want to limit items (e.g., max 5)
            $max = !empty($instance['max_items']) ? (int)$instance['max_items'] : 5;
            $instance['items'] = array_slice($instance['items'], 0, $max);
        } else {
            $instance['items'] = array();
        }
        return $instance;
    }

    /**
     * Frontend Output
     */
    public function widget($args, $instance)
    {
        // Extract widget arguments
        echo $args['before_widget'];

        // Variables (safe defaults)
        $header      = ! empty($instance['header']) ? $instance['header'] : '';
        $image_id    = ! empty($instance['image_id']) ? $instance['image_id'] : '';
        $author_slug = ! empty($instance['author_slug']) ? $instance['author_slug'] : '';

    ?>

        <div class="tp-widget-author tp-widget-sidebar text-center mb-20">

            <?php if ($image_id): ?>
                <div class="tp-widget-author-thumb mb-35 pt-15">

                    <?php

                    // Display Image
                    if (! empty($instance['image_id'])) {
                        echo wp_get_attachment_image(
                            $instance['image_id'],
                            'full',
                            false,
                            ['class' => 'widget-image']
                        );
                    }


                    ?>

                </div>
            <?php endif; ?>

            <div class="tp-widget-author-content">

                <?php if ($author_slug): ?>
                    <span class="tp-widget-author-subtitle d-inline-block mb-5">
                        <?php echo esc_html($author_slug); ?>
                    </span>
                <?php endif; ?>

                <?php if ($header): ?>
                    <h3 class="tp-widget-author-title mb-15">
                        <a href="#"><?php echo esc_html($header); ?></a>
                    </h3>
                <?php endif; ?>
                <?php
                echo '<pre>';
                var_dump($instance);
                echo '</pre>';
                // Display items
                if (!empty($instance['elements'])) { ?>
                    <div class="tp-footer-social justify-content-center">
                        <?php
                        foreach ($instance['elements'] as $item) {

                        ?>
                            <?php if (!empty($item['icon']) && !empty($item['url'])): ?>
                                <a href="<?php echo esc_url($item['url']); ?>" target="_blank" rel="noopener">
                                    <i class="<?php echo esc_attr($item['icon']) ?>"></i>
                                </a>
                            <?php endif; ?>
                        <?php
                        }
                        ?>
                    </div>


                <?php
                }

                ?>

            </div>
        </div>



<?php
        echo $args['after_widget'];
    }
}
