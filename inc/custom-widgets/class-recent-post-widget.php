<?php
class WIB_Recent_Post_Widget extends WP_Widget
{

    public function __construct()
    {
        parent::__construct(
            'wib_recent_post_widget',
            __('WIB Recent Post Widget', 'textdomain'),
            array('description' => __('A widget with recent post title, post thumb and date fields', 'textdomain'))
        );
    }

    /**
     * Backend Widget Form
     */

    public function form($instance)
    {
        $instance = wp_parse_args(
            (array) $instance,
            array(
                'sortby'  => 'asc',
            )
        );

        $title     = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $number    = isset($instance['number']) ? absint($instance['number']) : 5;
        $show_date = isset($instance['show_date']) ? (bool) $instance['show_date'] : false;
        $show_image = isset($instance['show_image']) ? (bool) $instance['show_image'] : false;

?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:'); ?></label>
            <input class="tiny-text" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('sortby')); ?>"><?php _e('Sort by:'); ?></label>
            <select name="<?php echo esc_attr($this->get_field_name('sortby')); ?>" id="<?php echo esc_attr($this->get_field_id('sortby')); ?>" class="widefat">
                <option value="asc" <?php selected($instance['sortby'], 'asc'); ?>><?php _e('ASC'); ?></option>
                <option value="desc" <?php selected($instance['sortby'], 'desc'); ?>><?php _e('DESC'); ?></option>
            </select>
        </p>

        <p>
            <input class="checkbox" type="checkbox" <?php checked($show_date); ?> id="<?php echo $this->get_field_id('show_date'); ?>" name="<?php echo $this->get_field_name('show_date'); ?>" />
            <label for="<?php echo $this->get_field_id('show_date'); ?>"><?php _e('Display post date?'); ?></label>
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked($show_image); ?> id="<?php echo $this->get_field_id('show_image'); ?>" name="<?php echo $this->get_field_name('show_image'); ?>" />
            <label for="<?php echo $this->get_field_id('show_image'); ?>"><?php _e('Display post thumb/image?'); ?></label>
        </p>
    <?php
    }

    /**
     * Saving Widget Values
     */
    public function update($new_instance, $old_instance)
    {
        $instance              = $old_instance;
        $instance['title']     = sanitize_text_field($new_instance['title']);
        $instance['number']    = (int) $new_instance['number'];
        $instance['show_date'] = isset($new_instance['show_date']) ? (bool) $new_instance['show_date'] : false;
        $instance['show_image'] = isset($new_instance['show_image']) ? (bool) $new_instance['show_image'] : false;


        if (in_array($new_instance['sortby'], array('asc', 'desc'), true)) {
            $instance['sortby'] = $new_instance['sortby'];
        } else {
            $instance['sortby'] = 'asc';
        }

        return $instance;
    }

    /**
     * Frontend Output
     */
    public function widget($args, $instance)
    {
        if (! isset($args['widget_id'])) {
            $args['widget_id'] = $this->id;
        }

        $default_title = __('WIB Recent Posts');
        $title         = (! empty($instance['title'])) ? $instance['title'] : $default_title;

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters('widget_title', $title, $instance, $this->id_base);

        $sortby  = empty($instance['sortby']) ? 'ace' : $instance['sortby'];
        // if ('ascending' === $sortby) {
        //     $sortby = 'ascending, descending';
        // }

        $number = (! empty($instance['number'])) ? absint($instance['number']) : 5;
        if (! $number) {
            $number = 5;
        }
        $show_date = isset($instance['show_date']) ? $instance['show_date'] : false;
        $show_image = isset($instance['show_image']) ? $instance['show_image'] : false;

        // var_dump($sortby);

        $args = [
            'post_type'      => 'post',
            'posts_per_page' => $number,
            'post_status'    => 'publish',
            'order'          => $sortby
        ];

        $recent_posts = new WP_Query($args);
    ?>
        <div class="tp-widget-sidebar mb-20">
            <h3 class="tp-widget-main-title mb-35"><?php echo esc_html($title); ?></h3>
            <?php
            if ($recent_posts->have_posts()) :
                while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
                    <div class="tp-widget-post-list mb-15">
                        <?php if ($show_image): ?>
                            <div class="tp-widget-post-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <?php if (has_post_thumbnail()) {
                                        the_post_thumbnail();
                                    } ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="tp-widget-post-content">
                            <?php if ($show_date): ?>
                                <span><i class="far fa-clock"></i> <?php echo get_the_date('M j, Y'); ?></span>
                            <?php endif; ?>
                            <h4 class="tp-widget-post-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h4>
                        </div>
                    </div>
            <?php
                endwhile;
            endif;
            wp_reset_postdata();
            ?>
        </div>
<?php
    }
}
