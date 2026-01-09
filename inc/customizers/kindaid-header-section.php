<?php

function kindAid_header_settings()
{
    new \Kirki\Section(
        'kindaid_header_section',
        [
            'title'       => esc_html__('Header Section', 'kindaid'),
            'description' => esc_html__('My Section Description.', 'kindaid'),
            'panel'       => 'kirki_kindaid_settings',
            'priority'    => 160,
        ]
    );

    new \Kirki\Field\Image(
        [
            'settings'    => 'header_logo',
            'label'       => esc_html__('Image Control (URL)', 'kindaid'),
            'description' => esc_html__('The saved value will be the URL.', 'kindaid'),
            'section'     => 'kindaid_header_section',
            'default'     => get_template_directory_uri() . '/assets/img/logo/logo.png',
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'donate_btn_text',
            'label'    => esc_html__('Button Text', 'kindaid'),
            'section'  => 'kindaid_header_section',
            'default'  => esc_html__('Donate Now', 'kindaid'),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Text(
        [
            'settings' => 'donate_btn_url',
            'label'    => esc_html__('Button URL', 'kindaid'),
            'section'  => 'kindaid_header_section',
            'default'  => esc_html__('#', 'kindaid'),
            'priority' => 10,
        ]
    );

    new \Kirki\Field\Checkbox_Switch(
        [
            'settings'    => 'header_right_part_switch_setting',
            'label'       => esc_html__('Header right part Enable/Disable', 'kindaid'),
            'description' => esc_html__('You can enable of disabel header right part using this switch button', 'kindaid'),
            'section'     => 'kindaid_header_section',
            'default'     => 'on',
            'choices'     => [
                'on'  => esc_html__('Enable', 'kindaid'),
                'off' => esc_html__('Disable', 'kindaid'),
            ],
        ]
    );
}

kindAid_header_settings();
