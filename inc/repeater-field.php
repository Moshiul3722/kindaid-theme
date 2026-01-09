<?php

/**
 * Class Widget_Repeater_Field
 * Usage:
 * echo Widget_Repeater_Field::field( $this, $instance, 'social_links', 'Social Links' );
 */
class Widget_Repeater_Field
{

    /**
     * Render the repeater field
     */
    public static function field($widget, $instance, $field_id, $label)
    {

        $values = ! empty($instance[$field_id]) ? $instance[$field_id] : array();

?>
        <div class="widget-repeater-wrap" data-repeater="<?php echo esc_attr($widget->get_field_name($field_id)); ?>">
            <p><strong><?php echo esc_html($label); ?></strong></p>

            <div class="repeater-items">
                <?php if (! empty($values)) : ?>
                    <?php foreach ($values as $index => $value) : ?>
                        <div class="repeater-row">
                            <input type="text"
                                name="<?php echo esc_attr($widget->get_field_name($field_id)); ?>[]"
                                value="<?php echo esc_attr($value); ?>"
                                class="widefat" />

                            <button type="button" class="button remove-row">Remove</button>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <button type="button" class="button add-row">Add New</button>
        </div>

        <script>
            (function() {
                document.addEventListener('click', function(e) {

                    if (e.target.classList.contains('add-row')) {

                        let container = e.target.closest('.widget-repeater-wrap')
                            .querySelector('.repeater-items');

                        let index = container.querySelectorAll('.repeater-row').length;

                        container.insertAdjacentHTML('beforeend',
                            '<div class="repeater-row">' +
                            '<input type="text" name="<?php echo esc_attr($widget->get_field_name($field_id)); ?>[' + index + ']" class="widefat" />' +
                            '<button type="button" class="button remove-row">Remove</button>' +
                            '</div>'
                        );
                    }

                    if (e.target.classList.contains('remove-row')) {
                        e.target.closest('.repeater-row').remove();
                    }

                });
            })();
        </script>
<?php
    }


    /**
     * Handle saving the field
     */
    public static function save($new_instance, $old_instance, $field_id)
    {

        if (isset($new_instance[$field_id])) {

            $clean = array();

            foreach ((array) $new_instance[$field_id] as $value) {
                $value = sanitize_text_field($value);
                if ($value !== '') {
                    $clean[] = $value;
                }
            }

            $new_instance[$field_id] = $clean;
        }

        return $new_instance;
    }
}
