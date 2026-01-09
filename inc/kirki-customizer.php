<?php

new \Kirki\Panel(
    'kirki_kindaid_settings',
    [
        'priority'    => 10,
        'title'       => esc_html__('KindAid Settings', 'kirki'),
        'description' => esc_html__('My Panel Description.', 'kirki'),
    ]
);

require_once('customizers/kindaid-header-section.php');
require_once('customizers/kindaid-offcanvas-section.php');
require_once('customizers/kindaid-minicart-section.php');
