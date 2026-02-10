<?php

/**
 * Theme Function
 * 
 * @package KindAid
 */

// echo '<pre>';
// print_r(KINDAID_DIR_PATH);
// echo '</pre>';


if (! defined('KINDAID_DIR_PATH')) {
    define('KINDAID_DIR_PATH', untrailingslashit(get_template_directory()));
}

if (! defined('KINDAID_DIR_URI')) {
    define('KINDAID_DIR_URI', untrailingslashit(get_template_directory_uri()));
}


if (! function_exists('kindaid_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     *
     * @since Twenty Fifteen 1.0
     */
    function kindaid_setup()
    {

        /*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on kindaid, use a find and replace
	 * to change 'kindaid' to the name of your theme in all the template files
	 */
        load_theme_textdomain('kindaid', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded  tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
        add_theme_support('title-tag');

        /*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
        add_theme_support('post-thumbnails');
        add_image_size('post-thumb', 959, 494);

        // This theme uses wp_nav_menu() in two locations.
        register_nav_menus(array(
            'primary_menu' => __('Primary Menu', 'kindaid'),
            'footer_menu'  => __('Footer Menu', 'kindaid'),
        ));

        /*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption'
        ));

        /*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
        add_theme_support('post-formats', array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
            'gallery',
            'status',
            'audio',
            'chat'
        ));


        /**
         * Remove block theme editor
         */

        remove_theme_support('widgets-block-editor');
    }
endif; // kindaid_setup
add_action('after_setup_theme', 'kindaid_setup');


/**
 * Adding template CSS & JS files
 */

function add_theme_scripts()
{
    wp_enqueue_style('style', get_stylesheet_uri());
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '5.3.8', 'all');
    wp_enqueue_style(
        'fa-icons',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css',
        [],
        null
    );
    wp_enqueue_style('animate', get_template_directory_uri() . '/assets/css/animate.css', array(), '1.1', 'all');
    wp_enqueue_style('swiper-bundle', get_template_directory_uri() . '/assets/css/swiper-bundle.css', array(), '6.5.0', 'all');
    wp_enqueue_style('magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup.css', array(), '1.1', 'all');
    wp_enqueue_style('font-awesome-pro', get_template_directory_uri() . '/assets/css/font-awesome-pro.css', array(), '6.0.0', 'all');
    wp_enqueue_style('spacing', get_template_directory_uri() . '/assets/css/spacing.css', array(), '1.1', 'all');
    wp_enqueue_style('main', get_template_directory_uri() . '/assets/css/main.css', array(), '1.1', 'all');

    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap-min.js', array('jquery'), 1.1, true);
    wp_enqueue_script('swiper-bundle', get_template_directory_uri() . '/assets/js/swiper-bundle.js', array('jquery'), '6.5.0', true);
    wp_enqueue_script('magnific-popup', get_template_directory_uri() . '/assets/js/magnific-popup.js', array('jquery'), '1.1.0', true);
    wp_enqueue_script('nice-select', get_template_directory_uri() . '/assets/js/nice-select.js', array('jquery'), 1.0, true);
    wp_enqueue_script('purecounter', get_template_directory_uri() . '/assets/js/purecounter.js', array('jquery'), '1.5.0', true);
    wp_enqueue_script('imagesloaded-pkgd', get_template_directory_uri() . '/assets/js/imagesloaded-pkgd.js', array('jquery'), '4.1.4', true);
    wp_enqueue_script('range-slider', get_template_directory_uri() . '/assets/js/range-slider.js', array('jquery'), '1.12.1', true);
    wp_enqueue_script('ajax-form', get_template_directory_uri() . '/assets/js/ajax-form.js', array('jquery'), 1.1, true);
    wp_enqueue_script('parallax', get_template_directory_uri() . '/assets/js/parallax.js', array('jquery'), 1.1, true);
    wp_enqueue_script('parallax-scroll', get_template_directory_uri() . '/assets/js/parallax-scroll.js', array('jquery'), 1.1, true);
    wp_enqueue_script('wow', get_template_directory_uri() . '/assets/js/wow.min.js', array('jquery'), 1.1, true);
    wp_enqueue_script('slider-init', get_template_directory_uri() . '/assets/js/slider-init.js', array('jquery'), 1.1, true);
    wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), 1.1, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'add_theme_scripts');

add_filter('the_content', 'limit_elementor_content_words', 20);

add_filter('the_content', 'limit_elementor_content_words', 20);

// show limited content for blog page
function limit_elementor_content_words($content)
{

    // Admin & editor safety
    if (is_admin()) {
        return $content;
    }

    // ❌ DO NOT limit single post page
    if (is_single()) {
        return $content;
    }

    // ✅ Only for blog list / archive / home
    if (! is_home() && ! is_archive()) {
        return $content;
    }

    $limit = 30;

    $text  = wp_strip_all_tags($content);
    $words = preg_split('/\s+/u', trim($text));

    if (count($words) <= $limit) {
        return $content;
    }

    $excerpt = array_slice($words, 0, $limit);

    return '<p>' . esc_html(implode(' ', $excerpt)) . '...</p>';
}




/**
 * Adding kirki customizer fileds
 */
function solub_kirki()
{
    if (class_exists('kirki')) {
        include_once('inc/kirki-customizer.php');
    }
}
add_action('init', 'solub_kirki');



require_once('inc/theme-helper.php');
require_once('inc/nav-walker.php');
require_once('inc/kindaid-metafields.php');
require_once('inc/theme-widget.php');
// require_once('inc/footer-info.php');


require_once get_template_directory() . '/inc/repeater-field.php';

// require gallery-metabox
require get_template_directory() . '/inc/gallery-metabox/class-gallery-metabox.php';

// Initialize the class
new Theme_Gallery_Metabox();

// Video metabox
require get_template_directory() . '/inc/video-metabox/video-metabox.php';
new VideoMetaBox();

// audio metabox
require get_template_directory() . '/inc/audio-metabox/audio-metabox.php';
new Theme_Audio_Metabox();

// Biography metaboxs
require get_template_directory() . '/inc/biography-metabox/biography-metabox.php';
// new Post_Biography_Meta_Box();

require get_template_directory() . '/inc/biography-metabox/current_user_metabox.php';
// new Current_User_Meta();
add_action('init', function () {
    new Current_User_Repeater_Meta();
});

// Register Blog Sidebar

// include widget files
require_once get_template_directory() . '/inc/custom-widgets/class-repeater-widget.php';
require_once get_template_directory() . '/inc/custom-widgets/class-author-widget.php';
require_once get_template_directory() . '/inc/custom-widgets/class-recent-post-widget.php';
require_once get_template_directory() . '/inc/custom-widgets/class-sidebar-donate-banner-widget.php';
require_once get_template_directory() . '/inc/custom-widgets/class-kindaid-footer1-widget.php';

// register repeater widget file
// function wib_register_repeater_widget()
// {
//     register_widget('Repeater_Widget');
// }
// add_action('widgets_init', 'wib_register_repeater_widget');

// register author widget file
function wib_register_author_widget()
{
    register_widget('Author_Widget');
}
add_action('widgets_init', 'wib_register_author_widget');

// register recent post widget file
function wib_recent_post_widget()
{
    register_widget('WIB_Recent_Post_Widget');
}
add_action('widgets_init', 'wib_recent_post_widget');

// register recent post widget file
function wib_sidebar_donate_banner_widget()
{
    register_widget('WIB_Sidebar_Donate_Banner');
}
add_action('widgets_init', 'wib_sidebar_donate_banner_widget');


function fix_elementor_dependencies()
{
    if (wp_script_is('elementor-v2-editor-interactions', 'registered')) {
        $script = wp_scripts()->registered['elementor-v2-editor-interactions'];

        // Remove the problematic dependencies
        $script->deps = array_diff($script->deps, array(
            'elementor-v2-editor-controls',
            'elementor-v2-editor-elements'
        ));
    }
}
add_action('wp_print_scripts', 'fix_elementor_dependencies', 100);

add_action('wp_print_scripts', 'fix_elementor_v2_dependencies', 100);
function fix_elementor_v2_dependencies()
{
    // Fix elementor-v2-editor-interactions
    if (wp_script_is('elementor-v2-editor-interactions', 'registered')) {
        $script = wp_scripts()->registered['elementor-v2-editor-interactions'];
        $script->deps = array_diff($script->deps, array(
            'elementor-v2-editor-controls',
            'elementor-v2-editor-elements'
        ));
    }

    // Fix elementor-v2-editor-components
    if (wp_script_is('elementor-v2-editor-components', 'registered')) {
        $script = wp_scripts()->registered['elementor-v2-editor-components'];
        $script->deps = array_diff($script->deps, array(
            'elementor-v2-editor-canvas',
            'elementor-v2-editor-controls',
            'elementor-v2-editor-editing-panel',
            'elementor-v2-editor-elements',
            'elementor-v2-editor-props',
            'elementor-v2-editor-styles-repository'
        ));
    }
}
