<?php

function kindaid_widgets()
{
    register_sidebar(array(
        'name'          => __('Blog Sidebar', 'kindaid'),
        'id'            => 'kindaid-blog-sidebar',
        'description'   => __('Widgets in this area will be shown on blog sidebar', 'kindaid'),
        'before_widget'    => '<div id="%1$s" class="tp-widget-sidebar mb-20 %2$s">',
        'after_widget'    => '</div>',
        'before_title'    => '<h3 class="tp-widget-main-title mb-25">',
        'after_title'    => '</h3>',
    ));


    register_sidebar(array(
        'name'          => __('Footer 1: Widget 1', 'kindaid'),
        'id'            => 'footer-1-widget-1',
        'description'   => __('Widgets in this area will be shown on Footer 1: Widget 1', 'kindaid'),
        'before_widget' => '<div id="%1$s" class="tp-footer-widget mb-40 wow fadeInUp %2$s" data-wow-duration=".9s" data-wow-delay=".3s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="tp-footer-title mb-15">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('Footer 2: Widget 2', 'kindaid'),
        'id'            => 'footer-2-widget-2',
        'description'   => __('Widgets in this area will be shown on Footer 2: Widget 2', 'kindaid'),
        'before_widget' => '<div id="%1$s" class="tp-footer-widget ml-75 mb-50 wow fadeInUp %2$s" data-wow-duration=".9s" data-wow-delay=".4s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="tp-footer-title mb-15">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('Footer 3: Widget 3', 'kindaid'),
        'id'            => 'footer-3-widget-3',
        'description'   => __('Widgets in this area will be shown on Footer 3: Widget 3', 'kindaid'),
        'before_widget' => '<div id="%1$s" class="tp-footer-widget tp-footer-col-2 mb-50 wow fadeInUp %2$s" data-wow-duration=".9s" data-wow-delay=".6s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="tp-footer-title mb-15">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('Footer 4: Widget 4', 'kindaid'),
        'id'            => 'footer-4-widget-4',
        'description'   => __('Widgets in this area will be shown on Footer 3: Widget 3', 'kindaid'),
        'before_widget' => '<div id="%1$s" class="tp-footer-widget mb-40 wow fadeInUp %2$s" data-wow-duration=".9s" data-wow-delay=".6s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="tp-footer-title mb-15">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'kindaid_widgets');
