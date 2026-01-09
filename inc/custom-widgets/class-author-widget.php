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
        // wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css', [], '6.5.1');

        // Local CSS
        wp_enqueue_style(
            'author-widget',
            get_template_directory_uri() . '/inc/custom-widgets/assets/css/author-widget.css'
        );
    }


    public function enqueue_admin_assets($hook)
    {
        if ($hook !== 'widgets.php') return;

        // wp_enqueue_style(
        //     'fontawesome-admin',
        //     'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css',
        //     [],
        //     '6.5.1'
        // );

        // Local JS
        wp_enqueue_script(
            'author-widget-admin',
            get_template_directory_uri() . '/inc/custom-widgets/assets/js/author-widget-admin.js',
            ['jquery'],
            time(),
            true
        );

        wp_enqueue_media();
    }

    /**
     * Backend Widget Form
     */

    public function form($instance)
    {
        // instance for repeater items
        $elements = isset($instance['wib_elements']) && is_array($instance['wib_elements'])
            ? $instance['wib_elements']
            : [];


        if (empty($elements)) {
            $elements[] = [
                'icon' => '',
                'url'  => ''
            ];
        }

        // end repeater items

        // adding image field
        $image_id  = ! empty($instance['image_id']) ? $instance['image_id'] : '';
        $author_name  = ! empty($instance['author_name']) ? $instance['author_name'] : '';
        $description  = ! empty($instance['description']) ? $instance['description'] : '';
        // Input names for image
        $image_url = $image_id ? wp_get_attachment_url($image_id) : '';

?>

        <!-- Author Information -->

        <p class="image-field-wrapper">

            <label><strong>Image (200x200):</strong></label><br>

            <img class="widget-image-preview"
                src="<?php echo esc_url($image_url); ?>"
                style="max-width:100%; <?php echo $image_url ? '' : 'display:none;'; ?>">

            <input type="hidden"
                class="widget-image-id"
                name="<?php echo $this->get_field_name('image_id'); ?>"
                value="<?php echo esc_attr($image_id); ?>">
            <br />
            <button type="button" class="button select-image">
                <?php echo $image_url ? 'Change Image' : 'Select Image'; ?>
            </button>

            <button type="button" class="button remove-image"
                style="<?php echo $image_url ? '' : 'display:none;'; ?>">
                Remove
            </button>

        </p>

        <!-- Author name, Description & Max Items -->
        <div style="display: flex; margin-bottom:7px">
            <div style="flex: 2;">
                <input class="widefat" type="text"
                    name="<?php echo $this->get_field_name('author_name'); ?>"
                    value="<?php echo esc_attr($author_name); ?>"
                    placeholder="Author Name">
            </div>
            <div style="flex: 2; margin-left:7px;">
                <input class="widefat" type="text"
                    name="<?php echo $this->get_field_name('description'); ?>"
                    value="<?php echo esc_attr($description); ?>"
                    placeholder="Description">
            </div>
            <div style="flex: 1; margin-left: 7px">
                <input class="widefat max-item-input" type="number" min="1" name="maxItem" value="1">
            </div>
        </div>

        <!-- Repeater items -->
        <div class="repeater-wrapper"
            data-name="<?php echo esc_attr($this->get_field_name('wib_elements')); ?>">

            <div class="repeater-items">
                <?php foreach ($elements as $index => $element) : ?>
                    <div class="repeater-item">

                        <input type="text" class="widefat"
                            name="<?php echo $this->get_field_name('wib_elements'); ?>[<?php echo $index; ?>][icon]"
                            value="<?php echo esc_attr($element['icon'] ?? ''); ?>"
                            placeholder="Icon (fontawesome)">

                        <input type="text" class="widefat"
                            name="<?php echo $this->get_field_name('wib_elements'); ?>[<?php echo $index; ?>][url]"
                            value="<?php echo esc_attr($element['url'] ?? ''); ?>"
                            placeholder="https://www.example.com">

                        <button type="button" class="button remove-item">Remove</button>
                    </div>
                <?php endforeach; ?>
            </div>

            <button type="button" class="button add-item">Add Item</button>

            <p class="limit-message" style="display:none; color:#D34E4E; border: 1px solid; border-radius: 4px; padding:2px 5px 2px 5px; background: #FCF5EE">Maximum limit reached</p>
        </div>

    <?php
    }

    /**
     * Saving Widget Values
     */
    public function update($new_instance, $old_instance)
    {
        $instance = [];

        $instance['image_id'] = ! empty($new_instance['image_id']) ? absint($new_instance['image_id']) : '';
        $instance['author_name'] = (!empty($new_instance['author_name'])) ? sanitize_text_field($new_instance['author_name']) : '';
        $instance['description'] = (!empty($new_instance['description'])) ? sanitize_text_field($new_instance['description']) : '';

        var_dump($instance['author_name']);
        // Items array save
        $instance['wib_elements'] = [];

        if (!empty($new_instance['wib_elements']) && is_array($new_instance['wib_elements'])) {
            foreach ($new_instance['wib_elements'] as $el) {

                if (empty($el['icon']) && empty($el['url'])) {
                    continue; // 👈 EMPTY ROW বাদ
                }

                $instance['wib_elements'][] = [
                    'icon' => sanitize_text_field($el['icon'] ?? ''),
                    'url'  => sanitize_text_field($el['url'] ?? ''),
                ];
            }
        }
        return $instance;
    }

    /**
     * Frontend Output
     */
    public function widget($args, $instance)
    {
        // Extract widget arguments
        // echo $args['before_widget'];
        $image_id    = ! empty($instance['image_id']) ? $instance['image_id'] : '';
        $author_name    = ! empty($instance['author_name']) ? $instance['author_name'] : '';
        $description    = ! empty($instance['description']) ? $instance['description'] : '';
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

                <?php if ($author_name): ?>
                    <span class="tp-widget-author-subtitle d-inline-block mb-5">
                        <?php echo esc_html($author_name); ?>
                    </span>
                <?php endif; ?>

                <?php if ($description): ?>
                    <h3 class="tp-widget-author-title mb-15">
                        <a href="#"><?php echo esc_html($description); ?></a>
                    </h3>
                <?php endif; ?>
                <?php
                if (!empty($instance['wib_elements'])) { ?>
                    <div class="tp-footer-social justify-content-center">
                        <?php
                        foreach ($instance['wib_elements'] as $item) {

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
        // echo $args['after_widget'];
    }
}
