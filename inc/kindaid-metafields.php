<?php

add_filter('tp_meta_boxes', 'kindaid_metafields');
function kindaid_metafields($meta_boxes)
{
    $meta_boxes[] = array(
        'metabox_id'       => 'kindaid-metafields',
        'title'    => esc_html__('Page Options', 'kindaid'),
        'post_type' => 'page', // page, custom post type name
        'context'  => 'normal',
        'priority' => 'core',
        'fields'   => array(
            array(
                'label'           => esc_html__('Header Select', 'kindaid'),
                'id'              => "header-from-page",
                'type'            => 'select',
                'options'         => array(
                    'header-1' => __('Header One', 'kindaid'),
                    'header-2' => __('Header Two', 'kindaid'),
                    'header-3' => __('Header Three', 'kindaid'),
                ),
                'placeholder'     => __('Select an item', 'kindaid'),
                'conditional' => array(),
                'default' => 'header-1'
            ),
        ),
    );

    return $meta_boxes;
}
