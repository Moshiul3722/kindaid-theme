<?php

function kindAid_offcanvas_settings()
{
    new \Kirki\Section(
        'kindaid_offcanvas_section',
        [
            'title'       => esc_html__('Offcanvas Section', 'kindaid'),
            'description' => esc_html__('My Section Description.', 'kindaid'),
            'panel'       => 'kirki_kindaid_settings',
            'priority'    => 160,
        ]
    );

    new \Kirki\Field\Image(
        [
            'settings'    => 'offcanvas_logo',
            'label'       => esc_html__('Image Control (URL)', 'kindaid'),
            'description' => esc_html__('The saved value will be the URL.', 'kindaid'),
            'section'     => 'kindaid_offcanvas_section',
            'default'     => get_template_directory_uri() . '/assets/img/logo/logo.png',
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'offcanvas_title',
            'label'    => esc_html__('Offcanvas Title', 'kindaid'),
            'section'  => 'kindaid_offcanvas_section',
            'default'  => esc_html__('Hello There!', 'kindaid'),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Textarea(
        [
            'settings'    => 'offcanvas_description',
            'label'       => esc_html__('Offcanvas Description', 'kindaid'),
            'section'     => 'kindaid_offcanvas_section',
            'default'     => esc_html__('Lorem ipsum dolor sit amet, consect etur adipiscing elit.', 'kindaid'),
        ]
    );

    new \Kirki\Field\Repeater(
        [
            'settings'     => 'offcanvas_gallery',
            'label'        => esc_html__('Repeater Control', 'kindaid'),
            'section'      => 'kindaid_offcanvas_section',
            'priority'     => 10,
            'row_label'    => [
                'type'  => 'field',
                'value' => esc_html__('Image -', 'kindaid'),
                'field' => 'link_text',
            ],
            'button_label' => esc_html__('Add new', 'kindaid'),

            'fields'       => [
                'image'   => [
                    'type'        => 'image',
                    'label'       => esc_html__('Offcanvas Image', 'kindaid'),
                    'description' => '',
                    'default'     => get_template_directory_uri() . '/assets/img/gallery/gallery-1.jpg',
                ],

            ],
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings'    => 'offcanvas_information_title',
            'label'       => esc_html__('Information Title', 'kindaid'),
            'section'     => 'kindaid_offcanvas_section',
            'default'     => esc_html__('Information', 'kindaid'),
            'priority'     => 11,
        ]
    );

    new \Kirki\Field\Repeater(
        [
            'settings'     => 'offcanvas_informations',
            'label'        => esc_html__('Informations', 'kindaid'),
            'section'      => 'kindaid_offcanvas_section',
            'priority'     => 12,
            'row_label'    => [
                'type'  => 'field',
                'value' => esc_html__('Information -', 'kindaid'),
                'field' => 'link_text',
            ],
            'button_label' => esc_html__('Add new', 'kindaid'),

            'fields'       => [
                'info_text'   => [
                    'type'        => 'text',
                    'label'       => esc_html__('Information Text', 'kindaid'),
                    'description' => 'phone, email, address etc',
                    'default'     => '',
                ],

                'info_link'   => [
                    'type'        => 'text',
                    'label'       => esc_html__('Information Link', 'kindaid'),
                    'description' => 'phone, email, address etc',
                ],

            ],
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings'    => 'offcanvas_follows',
            'label'       => esc_html__('Social Title', 'kindaid'),
            'section'     => 'kindaid_offcanvas_section',
            'default'     => esc_html__('Follow Us', 'kindaid'),
            'priority'     => 13,
        ]
    );
    new \Kirki\Field\Text(
        [
            'settings'    => 'offcanvas_follows_fb',
            'label'       => esc_html__('Facebook Link', 'kindaid'),
            'section'     => 'kindaid_offcanvas_section',
            'default'     => esc_html__('Facebook Link', 'kindaid'),
            'priority'     => 13,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings'    => 'offcanvas_follows_twiter',
            'label'       => esc_html__('Twitter Link', 'kindaid'),
            'section'     => 'kindaid_offcanvas_section',
            'default'     => esc_html__('Twitter Link', 'kindaid'),
            'priority'     => 13,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings'    => 'offcanvas_follows_instagram',
            'label'       => esc_html__('Instagram Link', 'kindaid'),
            'section'     => 'kindaid_offcanvas_section',
            'default'     => esc_html__('Instagram Link', 'kindaid'),
            'priority'     => 13,
        ]
    );
}

kindAid_offcanvas_settings();
