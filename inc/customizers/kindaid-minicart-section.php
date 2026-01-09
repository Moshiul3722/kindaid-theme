<?php

function kindAid_minicart_settings()
{
    new \Kirki\Section(
        'kindaid_minicart_section',
        [
            'title'       => esc_html__('Minicart Section', 'kindaid'),
            'description' => esc_html__('My Section Description.', 'kindaid'),
            'panel'       => 'kirki_kindaid_settings',
            'priority'    => 160,
        ]
    );

    new \Kirki\Field\Image(
        [
            'settings'    => 'minicart_logo',
            'label'       => esc_html__('Image Control (URL)', 'kindaid'),
            'description' => esc_html__('The saved value will be the URL.', 'kindaid'),
            'section'     => 'kindaid_minicart_section',
            'default'     => get_template_directory_uri() . '/assets/img/logo/logo.png',
        ]
    );
}

kindAid_minicart_settings();
