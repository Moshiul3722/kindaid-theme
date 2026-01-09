<?php
if (! class_exists('Current_User_Repeater_Meta')) {

    class Current_User_Repeater_Meta
    {

        private $meta_key = 'current_user_repeater_text';

        public function __construct()
        {
            add_action('show_user_profile', [$this, 'render_fields']);
            add_action('personal_options_update', [$this, 'save_fields']);
            add_action('admin_enqueue_scripts', [$this, 'enqueue_scripts']);
        }

        public function enqueue_scripts($hook)
        {
            if ($hook !== 'profile.php') {
                return;
            }

            wp_enqueue_script(
                'user-repeater-meta',
                get_template_directory_uri() . '/inc/biography-metabox/user-repeater-meta.js',
                ['jquery'],
                null,
                true
            );
        }

        public function render_fields($user)
        {

            if (get_current_user_id() !== (int) $user->ID) {
                return;
            }

            $values = get_user_meta($user->ID, $this->meta_key, true);

            if (! is_array($values)) {
                $values = [];
            }
?>
            <h3>Extra Profile Information</h3>

            <table class="form-table">
                <tr>
                    <th>User Social Bio <p>for icon use fontawesome or dash icon</p>
                    </th>
                    <td>
                        <div id="user-repeater-wrapper">

                            <?php foreach ($values as $index => $row) : ?>
                                <div class="repeater-row" style="margin-bottom:5px; padding:10px; border:1px solid #ddd; border-radius:4px; background:#f9f9f9;">
                                    <div style="display:flex; gap:10px;">
                                        <input type="text"
                                            name="<?php echo esc_attr($this->meta_key); ?>[<?php echo $index; ?>][icon]"
                                            value="<?php echo isset($row['icon']) ? esc_attr($row['icon']) : ''; ?>"
                                            placeholder="fa-brands fa-facebook-f"
                                            class="regular-text">
                                        <input type="text"
                                            name="<?php echo esc_attr($this->meta_key); ?>[<?php echo $index; ?>][url]"
                                            value="<?php echo isset($row['url']) ? esc_attr($row['url']) : ''; ?>"
                                            placeholder="www.facebook.com"
                                            class="regular-text">
                                        <button type="button" class="button remove-row">Remove</button>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <!-- খালি ডিফল্ট রো শুধুমাত্র তখনই যোগ করুন যখন কোনো ভ্যালু নেই -->
                            <?php if (empty($values)) : ?>
                                <div class="repeater-row" style="margin-bottom:5px; padding:10px; border:1px solid #ddd; border-radius:4px; background:#f9f9f9;">
                                    <div style="display:flex; gap:10px;">
                                        <input type="text"
                                            name="<?php echo esc_attr($this->meta_key); ?>[new_1][icon]"
                                            placeholder="fa-brands fa-facebook-f"
                                            class="regular-text">
                                        <input type="text"
                                            name="<?php echo esc_attr($this->meta_key); ?>[new_1][url]"
                                            placeholder="www.facebook.com"
                                            class="regular-text">
                                        <button type="button" class="button button-small remove-row">Remove</button>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <button type="button" class="button button-secondary add-row">
                                Add More
                            </button>

                        </div>
                    </td>
                </tr>
            </table>
<?php
        }

        public function save_fields($user_id)
        {

            if (get_current_user_id() !== (int) $user_id) {
                return;
            }

            if (! isset($_POST[$this->meta_key])) {
                return;
            }

            $submitted_data = (array) $_POST[$this->meta_key];
            $clean_data = [];

            foreach ($submitted_data as $row) {
                if (isset($row['icon']) || isset($row['url'])) {
                    $icon = isset($row['icon']) ? sanitize_text_field($row['icon']) : '';
                    $url = isset($row['url']) ? sanitize_text_field($row['url']) : '';

                    // শুধুমাত্র খালি নয় এমন রো সেভ করুন
                    if ($icon !== '' || $url !== '') {
                        $clean_data[] = [
                            'icon' => $icon,
                            'url' => $url
                        ];
                    }
                }
            }

            update_user_meta($user_id, $this->meta_key, $clean_data);
        }
    }
}
