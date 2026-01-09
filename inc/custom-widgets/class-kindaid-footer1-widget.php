<?php
class Footer1_Widget extends WP_Widget
{

    public function __construct()
    {
        parent::__construct(
            'kindaid_footer1_widget',
            __('WIB KindAid Footer-1 Widget', 'text_domain'),
            array('description' => __('A widget with repeatable items', 'text_domain'))
        );
    }

    public function form($instance)
    {
        // adding image field
        $image_id  = ! empty($instance['image_id']) ? $instance['image_id'] : '';
        // Input names for image
        $image_url = $image_id ? wp_get_attachment_url($image_id) : '';
        $description  = ! empty($instance['description']) ? $instance['description'] : '';
        $img_url  = ! empty($instance['img_url']) ? $instance['img_url'] : '';
        $img_width  = ! empty($instance['img_width']) ? $instance['img_width'] : '';
        $img_height  = ! empty($instance['img_height']) ? $instance['img_height'] : '';

        $max_items = !empty($instance['max_items']) ? $instance['max_items'] : '5';
        $items = !empty($instance['items']) ? $instance['items'] : array(array('text1' => '', 'text2' => ''));

        // Always ensure at least one item exists
        if (empty($items)) {
            $items = array(array('text1' => '', 'text2' => ''));
        }

        // Generate a unique ID for this widget instance
        $widget_id = $this->id;
?>
        <!-- Author Information -->
        <p class="footer1-image-field-wrapper">

            <label><strong>Footer Logo:</strong></label><br>

            <img class="footer1-image-preview"
                src="<?php echo esc_url($image_url); ?>"
                style="max-width:100%; <?php echo $image_url ? '' : 'display:none;'; ?>">

            <input type="hidden"
                class="footer1-image-id"
                name="<?php echo $this->get_field_name('image_id'); ?>"
                value="<?php echo esc_attr($image_id); ?>">
            <br />
            <button type="button" class="button footer1-select-image">
                <?php echo $image_url ? 'Change Image' : 'Select Image'; ?>
            </button>

            <button type="button" class="button footer1-remove-image"
                style="<?php echo $image_url ? '' : 'display:none;'; ?>">
                Remove
            </button>

        </p>

        <div style="display:flex; gap:10px">
            <div style="flex:1">
                <label for="<?php echo $this->get_field_id('img_width'); ?>"><?php _e('Image Width (px):'); ?></label>
                <input class="widefat" type="text" name="<?php echo $this->get_field_name('img_width'); ?>" id="<?php echo $this->get_field_id('img_width'); ?>" value="<?php echo $img_width; ?>">
            </div>
            <div style="flex:1">
                <label for="<?php echo $this->get_field_id('img_height'); ?>"><?php _e('Image Height (px):'); ?></label>
                <input class="widefat" type="text" name="<?php echo $this->get_field_name('img_height'); ?>" id="<?php echo $this->get_field_id('img_height'); ?>" value="<?php echo $img_height; ?>">
            </div>
        </div>
        <p style="display:flex; flex-direction:column">
            <label for="<?php echo $this->get_field_id('img_url'); ?>"><?php _e('Image Url:'); ?></label>
            <input class="widefat" type="text" name="<?php echo $this->get_field_name('img_url'); ?>" id="<?php echo $this->get_field_id('img_url'); ?>" value="<?php echo $img_url; ?>">
        </p>

        <p style="display:flex; flex-direction:column">
            <label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Description:'); ?></label>
            <textarea name="<?php echo $this->get_field_name('description'); ?>" id="<?php echo $this->get_field_id('description'); ?>" cols="" rows="3"><?php echo $description; ?></textarea>
        </p>

        <div style="display:flex; justify-content: flex-end; gap:10px; align-items:center; margin-bottom: 7px">
            <div style="display:flex; justify-content: space-between; width: 100%; margin-bottom: 4px">
                <label for="<?php echo $this->get_field_id('max_items'); ?>"><?php _e('Social Links:'); ?></label>
                <label for="<?php echo $this->get_field_id('max_items'); ?>"><?php _e('Max Items:'); ?></label>
            </div>
            <input class="tiny-text" id="<?php echo $this->get_field_id('max_items'); ?>"
                name="<?php echo $this->get_field_name('max_items'); ?>"
                type="number" min="1" max="20" value="<?php echo esc_attr($max_items); ?>" />
        </div>

        <div class="repeater-wrapper-widget" id="repeater-wrapper-<?php echo esc_attr($widget_id); ?>"
            data-widget-id="<?php echo esc_attr($widget_id); ?>"
            data-min-rows="1" data-max-items="<?php echo esc_attr($max_items); ?>">
            <div class="repeater-rows">
                <?php
                foreach ($items as $index => $item) {
                    $is_last_row = ($index === count($items) - 1);
                ?>
                    <div class="repeater-row" data-row-index="<?php echo $index; ?>">
                        <div style="display:flex; flex-wrap: wrap; gap:10px; margin-bottom: 5px;">
                            <input class="widefat" type="text"
                                name="<?php echo $this->get_field_name('items'); ?>[<?php echo $index; ?>][text1]"
                                value="<?php echo esc_attr($item['text1']); ?>"
                                placeholder="Url"
                                class="regular-text">

                            <input class="widefat" type="text"
                                name="<?php echo $this->get_field_name('items'); ?>[<?php echo $index; ?>][text2]"
                                value="<?php echo esc_attr($item['text2']); ?>"
                                placeholder="Text"
                                class="regular-text">

                            <?php if ($is_last_row && count($items) > 1): ?>
                                <button type="button" class="button remove-row" style="color: red">Remove</button>
                            <?php elseif (count($items) === 1): ?>
                                <button type="button" class="button remove-row" style="color: #ccc; cursor: not-allowed;" disabled
                                    title="At least one item is required">Remove</button>
                            <?php else: ?>
                                <button type="button" class="button remove-row" style="color: red">Remove</button>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>

            <button type="button" class="button button-primary add-item"
                id="add-item-<?php echo esc_attr($widget_id); ?>"
                style="margin: 10px 0;">Add New Item</button>
            <p class="limit-message" style="display:none; color:#D34E4E; margin-top: 5px;">Maximum limit reached</p>
        </div>

        <script type="text/javascript">
            (function($) {
                $(document).off('click.cleanImageWidget').on('click.cleanImageWidget', '.footer1-image-field-wrapper .footer1-select-image', function(e) {
                    e.preventDefault();

                    let wrapper = $(this).closest('.footer1-image-field-wrapper');
                    let previewImage = wrapper.find('.footer1-image-preview');
                    let input = wrapper.find(".footer1-image-id");
                    let removeImage = wrapper.find('.footer1-remove-image');

                    let frame = wp.media({
                        title: 'Select Image',
                        button: {
                            text: 'Use this image'
                        },
                        multiple: false
                    });

                    frame.on('select', function() {
                        let attachment = frame.state().get('selection').first().toJSON();
                        previewImage.attr("src", attachment.url).show();
                        input.val(attachment.id).trigger("change");
                        $(this).text("Change Image");
                        removeImage.show();
                    });

                    frame.open();
                });

                // remove image
                $(document).on('click', '.footer1-image-field-wrapper .footer1-remove-image', function() {
                    let wrapper = $(this).closest('.footer1-image-field-wrapper');
                    wrapper.find(".footer1-image-preview").hide().attr("src", "");
                    wrapper.find(".footer1-image-id").val("");
                    wrapper.find(".footer1-select-image").text("Select Image");

                    $(this).hide();
                });


                $(document).ready(function() {
                    // Get unique widget ID
                    var widgetId = '<?php echo esc_js($widget_id); ?>';
                    var widgetWrapper = $('#repeater-wrapper-' + widgetId);

                    // Initialize the widget
                    initRepeaterWidget(widgetId);

                    function initRepeaterWidget(widgetId) {
                        var wrapper = $('#repeater-wrapper-' + widgetId);
                        var addButton = $('#add-item-' + widgetId);
                        var rowsContainer = wrapper.find('.repeater-rows');
                        var maxItemsInput = $('#<?php echo $this->get_field_id("max_items"); ?>');

                        // Clear any existing event handlers for this widget
                        addButton.off('click');
                        wrapper.off('click', '.remove-row');
                        maxItemsInput.off('change');

                        // Add item button click handler
                        addButton.on('click', function(e) {
                            e.preventDefault();
                            e.stopPropagation();

                            console.log('Add button clicked for widget:', widgetId);

                            var existingRows = rowsContainer.find('.repeater-row');
                            var newIndex = existingRows.length;
                            var maxItems = parseInt(maxItemsInput.val()) || 5;

                            // Check max items
                            if (existingRows.length >= maxItems) {
                                wrapper.find('.limit-message').show();
                                return;
                            }

                            // Create the field name base
                            var fieldName = "<?php echo $this->get_field_name('items'); ?>";

                            // Create new row HTML
                            var newRowHtml = '<div class="repeater-row" data-row-index="' + newIndex + '">' +
                                '<div style="display:flex; flex-wrap: wrap; gap:10px; margin-bottom: 5px;">' +
                                '<input class="widefat" type="text" ' +
                                'name="' + fieldName + '[' + newIndex + '][text1]" ' +
                                'value="" placeholder="Url" class="regular-text">' +

                                '<input class="widefat" type="text" ' +
                                'name="' + fieldName + '[' + newIndex + '][text2]" ' +
                                'value="" placeholder="Text" class="regular-text">' +
                                '<button type="button" class="button remove-row" style="color: red">Remove</button>' +
                                '</div>' +
                                '</div>';

                            // Append new row
                            rowsContainer.append(newRowHtml);

                            // Re-index all rows
                            reindexRows();

                            // Update remove buttons state
                            updateRemoveButtonsState();

                            // Hide limit message
                            wrapper.find('.limit-message').hide();

                            console.log('New row added. Total rows:', existingRows.length + 1);
                        });

                        // Remove item handler
                        wrapper.on('click', '.remove-row:not(:disabled)', function(e) {
                            e.preventDefault();
                            e.stopPropagation();

                            var existingRows = rowsContainer.find('.repeater-row');
                            var minRows = parseInt(wrapper.data('min-rows')) || 1;

                            // Don't allow removal if only one row left
                            if (existingRows.length <= minRows) {
                                alert('At least one item must remain.');
                                return;
                            }

                            if (confirm('Are you sure you want to remove this item?')) {
                                $(this).closest('.repeater-row').remove();
                                reindexRows();
                                updateRemoveButtonsState();
                            }

                            // 🔥 activate Save button after remove item
                            wrapper.closest(".widget-content").find("input:first").trigger("change");
                        });

                        // Max items change handler
                        maxItemsInput.on('change', function() {
                            var maxItems = parseInt($(this).val()) || 5;
                            var currentItems = rowsContainer.find('.repeater-row').length;

                            if (currentItems > maxItems) {
                                wrapper.find('.limit-message').text('You have ' + currentItems + ' items, but max is ' + maxItems + '. Remove some items.').show();
                            } else {
                                wrapper.find('.limit-message').hide();
                            }

                            wrapper.data('max-items', maxItems);
                        });

                        // Update remove buttons state
                        function updateRemoveButtonsState() {
                            var rows = rowsContainer.find('.repeater-row');
                            var removeButtons = rowsContainer.find('.remove-row');

                            if (rows.length <= 1) {
                                // Only one row - disable remove button
                                removeButtons.prop('disabled', true)
                                    .css({
                                        'color': '#ccc',
                                        'cursor': 'not-allowed'
                                    })
                                    .attr('title', 'At least one item is required');
                            } else {
                                // Multiple rows - enable remove buttons
                                removeButtons.prop('disabled', false)
                                    .css({
                                        'color': 'red',
                                        'cursor': 'pointer'
                                    })
                                    .removeAttr('title');
                            }
                        }

                        // Re-index rows function
                        function reindexRows() {
                            var rows = rowsContainer.find('.repeater-row');
                            var fieldName = "<?php echo $this->get_field_name('items'); ?>";

                            rows.each(function(index) {
                                var row = $(this);
                                row.attr('data-row-index', index);
                                row.find('input[name$="[text1]"]').attr('name', fieldName + '[' + index + '][text1]');
                                row.find('input[name$="[text2]"]').attr('name', fieldName + '[' + index + '][text2]');
                            });
                        }
                        // Initialize
                        updateRemoveButtonsState();
                    }
                });
            })(jQuery);
        </script>

        <style>
            .repeater-row {
                padding: 10px;
                background: #f9f9f9;
                border: 1px solid #ddd;
                margin-bottom: 10px;
                border-radius: 4px;
                position: relative;
            }

            .repeater-row input {
                flex: 1;
            }

            .remove-row:disabled {
                opacity: 0.5;
            }
        </style>
    <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['image_id'] = ! empty($new_instance['image_id']) ? absint($new_instance['image_id']) : '';
        $instance['max_items'] = (!empty($new_instance['max_items'])) ? absint($new_instance['max_items']) : 5;
        $instance['description'] = (!empty($new_instance['description'])) ? sanitize_text_field($new_instance['description']) : '';
        $instance['img_width'] = (!empty($new_instance['img_width'])) ? sanitize_text_field($new_instance['img_width']) : '';
        $instance['img_height'] = (!empty($new_instance['img_height'])) ? sanitize_text_field($new_instance['img_height']) : '';
        $instance['img_url'] = (!empty($new_instance['img_url'])) ? sanitize_text_field($new_instance['img_url']) : '';
        // Process items array - ensure at least one exists
        $instance['items'] = array();

        if (!empty($new_instance['items']) && is_array($new_instance['items'])) {
            // Filter out completely empty items but keep at least one
            $hasValidItems = false;

            foreach ($new_instance['items'] as $item) {
                if (isset($item['text1']) || isset($item['text2'])) {
                    $text1 = !empty($item['text1']) ? sanitize_text_field($item['text1']) : '';
                    $text2 = !empty($item['text2']) ? sanitize_text_field($item['text2']) : '';

                    // Only add if at least one field has value OR if this would be the only item
                    if (!empty($text1) || !empty($text2) || empty($instance['items'])) {
                        $instance['items'][] = array(
                            'text1' => $text1,
                            'text2' => $text2
                        );
                        $hasValidItems = true;
                    }
                }
            }

            // If no valid items, add one empty row
            if (!$hasValidItems || empty($instance['items'])) {
                $instance['items'] = array(array('text1' => '', 'text2' => ''));
            }
        } else {
            // Always have at least one item
            $instance['items'] = array(array('text1' => '', 'text2' => ''));
        }

        return $instance;
    }

    public function widget($args, $instance)
    {
        echo $args['before_widget'];

        $image_id    = ! empty($instance['image_id']) ? $instance['image_id'] : '';
        $items = !empty($instance['items']) ? $instance['items'] : array();
        $description    = ! empty($instance['description']) ? $instance['description'] : '';
        $img_width    = ! empty($instance['img_width']) ? $instance['img_width'] . 'px' : '100%';
        $img_height    = ! empty($instance['img_height']) ? $instance['img_height'] . 'px' : '100%';
        $img_url    = ! empty($instance['img_url']) ? $instance['img_url'] : '';

        if (!empty($header)) {
            echo $args['before_title'] . esc_html($header) . $args['after_title'];
        }
    ?>

        <div class="tp-footer-widget mb-40 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".3s">
            <div class="tp-footer-logo mb-25">

                <?php if ($image_id): ?>
                    <a href="<?php esc_url($img_url) ?>">
                        <?php
                        // image style width & height
                        $style = '';
                        if (! empty($instance['img_width'])) {
                            $style .= 'width:' . esc_attr($img_width) . '; height:' . esc_attr($img_height) . ';';
                        }

                        // Display Image
                        if (! empty($instance['image_id'])) {
                            echo wp_get_attachment_image(
                                $instance['image_id'],
                                'full',
                                false,
                                [
                                    'class' => 'widget-image',
                                    'style' => $style,
                                ]
                            );
                        }
                        ?>
                    </a>
                <?php endif; ?>

            </div>
            <p class="tp-footer-dec mb-30"><?php echo $description; ?></p>
            <div class="tp-footer-social">

                <?php
                if (!empty($items)) {
                    foreach ($items as $item) {
                        if (!empty($item['text1']) || !empty($item['text2'])) {
                            echo '<a href=' . esc_html($item['text1']) . '>';
                            if (!empty($item['text2'])) {
                ?>
                                <i class="<?php echo esc_html($item['text2']); ?>"></i>
                <?php

                            }
                            echo '</a>';
                        }
                    }
                }
                ?>
            </div>
        </div>


<?php
        echo $args['after_widget'];
    }
}

// Register the widget
function wib_kindair_footer1_widget()
{
    register_widget('Footer1_Widget');
}
add_action('widgets_init', 'wib_kindair_footer1_widget');
