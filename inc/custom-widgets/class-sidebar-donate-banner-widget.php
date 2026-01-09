<?php

class WIB_Sidebar_Donate_Banner extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'wib_sidebar_donate_banner_widget',
            __('WIB Sidebar Donate Banner Widget', 'kainaid'),
            array('description' => __('A widget for Sidebar Donate banner', 'kainaid'))
        );
    }


    /**
     * Backend Widget Form
     */

    public function form($instance)
    {
        // adding image field
        $image_id  = ! empty($instance['image_id']) ? $instance['image_id'] : '';
        // Input names for image
        $image_url = $image_id ? wp_get_attachment_url($image_id) : '';

        $title     = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $button_title     = isset($instance['button_title']) ? esc_attr($instance['button_title']) : '';
        $button_url     = isset($instance['button_url']) ? esc_attr($instance['button_url']) : '';
        $overlay_color     = isset($instance['overlay_color']) ? esc_attr($instance['overlay_color']) : '';
        $old_description = isset($instance['wib_description']) ?  $instance['wib_description'] : "";

        // $author_name  = ! empty($instance['author_name']) ? $instance['author_name'] : '';
        // $description  = ! empty($instance['description']) ? $instance['description'] : '';
?>
        <!-- Background Image -->

        <p class="image-field-wrapper">

            <label>Background Image:</label><br>

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

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

        <p>
            <label for="">Description</label>
            <textarea class="widefat"
                name="<?php echo $this->get_field_name("wib_description") ?>"
                id="<?php echo $this->get_field_id("wib_description") ?>" cols="30" rows="3"><?php echo $old_description; ?></textarea>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('button_title'); ?>"><?php _e('Button Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('button_title'); ?>" name="<?php echo $this->get_field_name('button_title'); ?>" type="text" value="<?php echo $button_title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('button_url'); ?>"><?php _e('Button URL:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('button_url'); ?>" name="<?php echo $this->get_field_name('button_url'); ?>" type="text" value="<?php echo $button_url; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('overlay_color'); ?>"><?php _e('BG Overlay Color:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('overlay_color'); ?>" name="<?php echo $this->get_field_name('overlay_color'); ?>" type="text" value="<?php echo $overlay_color; ?>" />
        </p>


        <script>
            /*
             * This script for media file
             */

            jQuery(document).ready(function($) {

                let ddMediaFrame;
                // Select Image
                $(document).on("click", ".select-image", function(e) {
                    e.preventDefault();

                    let button = $(this);
                    let img_wrapper = button.closest(".image-field-wrapper");
                    let previewImg = img_wrapper.find("img.widget-image-preview");
                    let input = img_wrapper.find(".widget-image-id");
                    let removeBtn = img_wrapper.find(".remove-image");

                    if (ddMediaFrame) {
                        ddMediaFrame.open();
                        return;
                    }

                    ddMediaFrame = wp.media({
                        title: "Select Image",
                        button: {
                            text: "Use this image",
                        },
                        multiple: false,
                    });

                    ddMediaFrame.on("select", function() {
                        let attachment = ddMediaFrame.state().get("selection").first().toJSON();
                        // console.log("form media----", attachment);

                        previewImg.attr("src", attachment.url).show();
                        input.val(attachment.id).trigger("change");

                        button.text("Change Image");
                        removeBtn.show();
                    });

                    ddMediaFrame.open();
                });

                // Remove Image
                $(document).on("click", ".remove-image", function(e) {
                    e.preventDefault();

                    let wrapper = $(this).closest("p");

                    wrapper.find(".widget-image-preview").hide().attr("src", "");
                    wrapper.find(".widget-image-id").val("");
                    wrapper.find(".select-image").text("Select Image");

                    $(this).hide();
                });

            });
        </script>
    <?php

    }

    /**
     * Saving Widget Values
     */
    public function update($new_instance, $old_instance)
    {
        $instance = [];

        $instance['image_id'] = ! empty($new_instance['image_id']) ? absint($new_instance['image_id']) : '';
        $instance['title']     = sanitize_text_field($new_instance['title']);
        $instance['button_title']     = sanitize_text_field($new_instance['button_title']);
        $instance['button_url']     = sanitize_text_field($new_instance['button_url']);
        $instance['overlay_color']     = sanitize_text_field($new_instance['overlay_color']);
        $instance['wib_description']     = wp_kses_post($new_instance['wib_description']);

        return $instance;
    }

    /**
     * Frontend Output
     */
    public function widget($args, $instance)
    {
        $image_id    = ! empty($instance['image_id']) ? $instance['image_id'] : '';
        $image_url = wp_get_attachment_image_url($image_id, 'full');


        $title    = ! empty($instance['title']) ? $instance['title'] : '';
        $description    = ! empty($instance['wib_description']) ? $instance['wib_description'] : '';
        $button_title    = ! empty($instance['button_title']) ? $instance['button_title'] : '';
        $button_url    = ! empty($instance['button_url']) ? $instance['button_url'] : '';
        // var_dump($description);
    ?>

        <div class="tp-widget-support bg-position mb-20" data-img-bg="<?php echo esc_url($image_url); ?>">
            <div class="tp-widget-sidebar">
                <span class="tp-section-subtitle mb-15 d-inline-block" data-color="#ffcf4e"><?php echo esc_html($title) ?></span>
                <h2 class="tp-widget-support-title"><?php echo $description ?></h2>
            </div>
            <a class="tp-btn tp-btn-secondary-white text-capitalize tp-btn-animetion w-100 justify-content-center" href="<?php echo esc_url($button_url) ?>">
                <span class="btn-icon">
                    <svg width="19" height="18" viewBox="0 0 19 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.15195 0.500138C6.71895 0.517281 7.26794 0.6157 7.79984 0.79554H7.85294C7.88894 0.812539 7.91594 0.831328 7.93394 0.848328C8.13283 0.911853 8.32093 0.983431 8.50093 1.08185L8.84293 1.23395C8.97793 1.30553 9.13992 1.43884 9.22992 1.49342C9.31992 1.54621 9.41892 1.60079 9.49992 1.66253C10.4998 0.902906 11.7139 0.491334 12.9649 0.500138C13.5328 0.500138 14.0998 0.579912 14.6389 0.759751C17.9607 1.83342 19.1577 5.45704 18.1578 8.62436C17.5908 10.2429 16.6638 11.7201 15.4498 12.9271C13.7119 14.6002 11.8048 16.0854 9.75192 17.3649L9.52692 17.5L9.29292 17.3559C7.23284 16.0854 5.31496 14.6002 3.56088 12.9181C2.3549 11.7111 1.42701 10.2429 0.851011 8.62436C-0.165978 5.45704 1.03101 1.83342 4.38887 0.740961C4.64987 0.651489 4.91897 0.588859 5.18897 0.553965H5.29696C5.54986 0.517281 5.80096 0.500138 6.05296 0.500138H6.15195ZM14.1709 3.3276C13.8019 3.20145 13.3969 3.39918 13.2619 3.77496C13.1359 4.15075 13.3339 4.56232 13.7119 4.69563C14.2888 4.91037 14.6749 5.47494 14.6749 6.10035V6.12808C14.6578 6.33297 14.7199 6.53071 14.8459 6.68281C14.9719 6.83491 15.1609 6.92349 15.3589 6.94228C15.7279 6.93244 16.0428 6.63807 16.0698 6.2614V6.15492C16.0968 4.90142 15.3328 3.76602 14.1709 3.3276Z" fill="currentColor" />
                    </svg>
                </span>
                <span class="btn-text"><?php echo esc_html($button_title) ?></span>
            </a>
        </div>

<?php
    }
}
