 <script>
     jQuery(document).ready(function($) {
         // Widget ID নিয়ে নিচ্ছি
         // var widgetId = '<?php //echo $this->id; 
                            ?>';
         // var maxItems = 5;
         let maxItems = <?php echo isset($instance['max_items']) ? (int)$instance['max_items'] : 5; ?>;

         // console.log(maxItems)

         // Remove duplicate handlers
         $(document).off("click", ".add-item");
         $(document).off("click", ".remove-row");

         // $(document).off("input change", ".max-item-input");

         // Detect change in max item input
         // $(document).on("input change", ".max-item-input", function() {

         // let newLimit = parseInt($(this).val()) || 0;
         // console.log("Updated Max Item Limit:", newLimit);

         // Update JS variable instantly
         // maxItems = newLimit;

         // Show the Add Item button again (for all widgets)
         // $(".add-item").show();

         // Hide limit message
         // $(".limit-message").hide();
         // });

         // Add item
         $(document).on("click", ".repeater-wrapper-widget .add-item", function() {
             let wrapper = $(this).closest('.repeater-wrapper-widget');
             let container = wrapper.find('.repeater-rows').first();

             let total = container.find('.repeater-row').length;

             console.log(total);

             //check limit
             // if (total >= maxItems) {
             // wrapper.find('.limit-message').show();
             // wrapper.find('.add-item').hide();
             // return;
             // }

             // wrapper.find('.limit-message').hide();

             //Show Add Item button when click on remove item button
             // $(document).on("click", ".remove-item", function() {
             //     wrapper.find('.add-item').show();
             // })

             // Create new index
             // let newIndex = total;

             //create new item
             container.append(`
                    <div class="repeater-row">
                        <div style="display:flex; flex-wrap: wrap; gap:10px;">
                            <input class="widefat" type="text"
                                name="<?php echo $this->get_field_name('items'); ?>[][text1]"
                                value=""
                                placeholder="Url"
                                class="regular-text">

                            <input class="widefat" type="text"
                                name="<?php echo $this->get_field_name('items'); ?>[][text2]"
                                value=""
                                placeholder="text"
                                class="regular-text">
                        </div>
                        <button type="button" class="button remove-row" style="border:1px solid red; color: red">-</button>
                    </div>
                    `);

         });

         // Remove item
         $(document).on("click", ".remove-row", function() {
             console.log("remove item");
             let wrapper = $(this).closest('.repeater-wrapper-widget');
             let container = wrapper.find('.repeater-rows');

             $(this).closest('.repeater-row').remove();

             wrapper.find('.limit-message').hide();

         });



     });
 </script>


 <?php
    class Repeater_Widget extends WP_Widget
    {

        public function __construct()
        {
            parent::__construct(
                'repeater_widget',
                __('WIB Repeater Widget', 'textdomain'),
                array('description' => __('A widget with header and repeater fields', 'textdomain'))
            );
        }

        /**
         * Backend Widget Form
         */

        public function form($instance)
        {

            $header = ! empty($instance['header']) ? $instance['header'] : '';
            $max_items = ! empty($instance['max_items']) ? $instance['max_items'] : '5';
            $items = ! empty($instance['items']) ? $instance['items'] : array();

            // Get field names
            $header_name = $this->get_field_name('header');
            $max_item_name = $this->get_field_name('max_items');
            $items_name = $this->get_field_name('items');

            // Ensure items is an array
            if (!is_array($items)) {
                $items = array();
            }

    ?>
         <div style="display: flex; justify-content: flex-end; margin:7px 0">
             <div>
                 <label style="margin-bottom: 5px;"><?php _e('Max Item:', 'kindaid'); ?></label>
                 <input class="tiny-text max-item-input" type="number" name="<?php echo esc_attr($max_item_name); ?>" value="<?php echo esc_attr($max_items); ?>">
             </div>
         </div>


         <div class="repeater-wrapper-widget" data-widget-id="<?php echo esc_attr($this->id); ?>">
             <div class="repeater-rows">
                 <?php if (empty($items)): ?>
                     <!-- Show empty row if no items exist -->
                     <div class="repeater-row">
                         <div style="display:flex; flex-wrap: wrap; gap:10px;">
                             <input class="widefat" type="text"
                                 name="<?php echo esc_attr($items_name); ?>[0][text1]"
                                 value=""
                                 placeholder="Url"
                                 class="regular-text">

                             <input class="widefat" type="text"
                                 name="<?php echo esc_attr($items_name); ?>[0][text2]"
                                 value=""
                                 placeholder="text"
                                 class="regular-text">
                         </div>
                         <button type="button" class="button remove-row" style="border:1px solid red; color: red">-</button>
                     </div>
                 <?php else: ?>
                     <?php foreach ($items as $index => $item): ?>
                         <div class="repeater-row">
                             <div style="display:flex; flex-wrap: wrap; gap:10px;">
                                 <input class="widefat" type="text"
                                     name="<?php echo esc_attr($items_name); ?>[<?php echo $index; ?>][text1]"
                                     value="<?php echo isset($item['text1']) ? esc_attr($item['text1']) : ''; ?>"
                                     placeholder="Url"
                                     class="regular-text">

                                 <input class="widefat" type="text"
                                     name="<?php echo esc_attr($items_name); ?>[<?php echo $index; ?>][text2]"
                                     value="<?php echo isset($item['text2']) ? esc_attr($item['text2']) : ''; ?>"
                                     placeholder="text"
                                     class="regular-text">
                             </div>
                             <button type="button" class="button remove-row" style="border:1px solid red; color: red">-</button>
                         </div>
                     <?php endforeach; ?>
                 <?php endif; ?>
             </div>

             <button type="button" class="button add-item" style="margin-bottom: 5px;">Add Item</button>
             <p class="limit-message" style="display:none; color:#D34E4E; border: 1px solid; border-radius: 4px; padding:2px 5px 2px 5px; background: #FCF5EE">Maximum limit reached</p>
         </div>


         <script>
             jQuery(document).ready(function($) {

                 // Remove duplicate handlers
                 $(document).off("click", ".add-item");
                 $(document).off("click", ".remove-row");

                 // Add item
                 $(document).on("click", ".repeater-wrapper-widget .add-item", function(e) {
                     e.preventDefault();
                     e.stopImmediatePropagation();

                     let wrapper = $(this).closest('.repeater-wrapper-widget');
                     let container = wrapper.find('.repeater-rows');

                     let totalRows = container.find('.repeater-row').length;

                     // Get the widget ID from data attribute
                     let widgetId = wrapper.data('widget-id');
                     let index = totalRows; // Next index

                     // Get the base field name properly
                     let fieldName = "<?php echo $this->get_field_name('items'); ?>";

                     //create new item
                     container.append(`
                    <div class="repeater-row">
                        <div style="display:flex; flex-wrap: wrap; gap:10px;">
                            <input class="widefat" type="text"
                                name="${fieldName}[${index}][text1]"
                                value=""
                                placeholder="Url"
                                class="regular-text">

                            <input class="widefat" type="text"
                                name="${fieldName}[${index}][text2]"
                                value=""
                                placeholder="text"
                                class="regular-text">
                        </div>
                        <button type="button" class="button remove-row" style="border:1px solid red; color: red">-</button>
                    </div>
                    `);

                 });

                 // Remove item
                 $(document).on("click", ".remove-row", function() {
                     console.log("remove item");
                     let wrapper = $(this).closest('.repeater-wrapper-widget');
                     let container = wrapper.find('.repeater-rows');

                     $(this).closest('.repeater-row').remove();

                     wrapper.find('.limit-message').hide();

                 });



             });
         </script>
         <style>
             .repeater-row {
                 margin-bottom: 8px;
                 display: flex;
                 gap: 8px;
             }

             .repeater-row input {
                 flex: 1;
             }
         </style>
 <?php
        }

        /**
         * Saving Widget Values
         */
        public function update($new_instance, $old_instance)
        {
            $instance = array();
            $instance['header'] = (!empty($new_instance['header'])) ? sanitize_text_field($new_instance['header']) : '';
            $instance['max_items'] = (!empty($new_instance['max_items'])) ? absint($new_instance['max_items']) : 5;

            // Handle items array
            $instance['items'] = array();

            if (!empty($new_instance['items']) && is_array($new_instance['items'])) {
                foreach ($new_instance['items'] as $item) {
                    if (!empty($item['text1']) || !empty($item['text2'])) {
                        $instance['items'][] = array(
                            'text1' => !empty($item['text1']) ? sanitize_text_field($item['text1']) : '',
                            'text2' => !empty($item['text2']) ? sanitize_text_field($item['text2']) : ''
                        );
                    }
                }
            }

            return $instance;
        }

        /**
         * Frontend Output
         */
        public function widget($args, $instance)
        {
            echo $args;
            // Extract widget arguments
            echo $args['before_widget'];

            // Display header
            if (!empty($instance['header'])) {
                echo $args['before_title']
                    . apply_filters('widget_title', $instance['header'])
                    . $args['after_title'];
            }

            // Display items
            if (!empty($instance['items'])) {
                echo '<ul>';
                foreach ($instance['items'] as $item) {
                    if (!empty($item)) {
                        echo '<li>' . esc_html($item) . '</li>';
                    }
                }
                echo '</ul>';
            }

            echo $args['after_widget'];
        }
    }
