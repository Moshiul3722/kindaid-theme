    <?php
    $donate_btn_text = get_theme_mod('donate_btn_text', __('Donate Now', 'kindaid'));
    $donate_btn_url = get_theme_mod('donate_btn_url', __('Donate Now', 'kindaid'));
    $donate_btn_icon = get_theme_mod('donate_btn_icon');

    $header_right_part_switch_setting = get_theme_mod('header_right_part_switch_setting', 'on');

    // var_dump($header_right_part_switch_setting);

    $header_menu_column = ($header_right_part_switch_setting == false) ? 'col-xxl-9 col-xl-10' : 'col-xxl-6 col-xl-6';
    $header_menu_right = ($header_right_part_switch_setting == false) ? 'text-end' : 'text-center';
    ?>

    <!--search-form-start -->
    <?php echo get_template_part('templates/header/header-search') ?>
    <!-- search-form-end -->

    <!-- tp-offcanvas start -->
    <?php echo get_template_part('templates/header/offcanvas') ?>
    <!-- tp-offcanvas end -->

    <!-- cart mini area start -->
    <?php echo get_template_part('templates/header/minicart') ?>
    <!-- cart mini area end -->

    <!-- header start -->
    <header class="tp-header-height">
        <div id="header-sticky" class="tp-header-area tp-header-2-style tp-header-lg-spacing tp-header-blur">
            <div class="container-fluid container-1790">
                <div class="row align-items-center">
                    <div class="col-xxl-3 col-xl-2 col-5">
                        <div class="tp-header-logo">
                            <?php theme_header_logo(); ?>
                        </div>
                    </div>
                    <div class="<?php echo esc_attr($header_menu_column) ?> d-none d-xl-block">
                        <div class="tp-main-menu <?php echo esc_attr($header_menu_right) ?>">
                            <nav class="tp-mobile-menu-active">
                                <?php kindaid_main_menu(); ?>
                            </nav>
                        </div>
                    </div>

                    <?php if (true == $header_right_part_switch_setting) : ?>
                        <div class="col-xxl-3 col-xl-4 col-7">
                            <div class="tp-header-action d-flex align-items-center justify-content-end">
                                <div class="tp-header-action-item">
                                    <button class="tp-header-action-btn cartmini-open-btn">
                                        <svg width="23" height="24" viewBox="0 0 23 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.5781 23H16.1324C19.6419 23 22.3343 21.7324 21.5695 16.6305L20.679 9.71622C20.2076 7.17051 18.5838 6.19622 17.159 6.19622H5.50953C4.06382 6.19622 2.5343 7.24384 1.98953 9.71622L1.09906 16.6305C0.449537 21.1562 3.06858 23 6.5781 23Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M6.42158 5.9448C6.42158 3.21389 8.63542 1.00004 11.3663 1.00004V1.00004C12.6814 0.994472 13.9445 1.51297 14.8763 2.4409C15.8082 3.36883 16.332 4.62973 16.332 5.9448V5.9448" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M7.97149 11.0991H8.02387" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M14.6453 11.0991H14.6977" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <span class="tp-header-action-badge">3</span>
                                    </button>
                                </div>
                                <div class="tp-header-action-item">
                                    <button class="tp-header-action-btn tp-search-click">
                                        <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10.5022 18.7778C15.4114 18.7778 19.3911 14.7981 19.3911 9.88889C19.3911 4.97969 15.4114 1 10.5022 1C5.59298 1 1.61328 4.97969 1.61328 9.88889C1.61328 14.7981 5.59298 18.7778 10.5022 18.7778Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M21.6131 21L16.7798 16.1667" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </div>
                                <?php if (!empty($donate_btn_text)): ?>
                                    <div class="tp-header-2-btn-wrap d-none d-md-block">
                                        <a class="tp-btn tp-btn-animetion tp-header-2-btn" href="<?php echo $donate_btn_url; ?>">
                                            <span class="btn-text"><?php echo $donate_btn_text; ?> </span>
                                            <span class="btn-icon">
                                                <?php echo $donate_btn_icon; ?>
                                            </span>
                                            <span class="btn-icon">
                                                <svg width="15" height="14" viewBox="0 0 15 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4.70996 0.000113962C5.18246 0.0142314 5.63995 0.0952827 6.0832 0.243385H6.12745C6.15745 0.257385 6.17995 0.272859 6.19495 0.286858C6.36069 0.339173 6.51744 0.39812 6.66744 0.479171L6.95244 0.604432C7.06494 0.663379 7.19994 0.773166 7.27494 0.818113C7.34993 0.861586 7.43243 0.906532 7.49993 0.957374C8.33317 0.331805 9.34491 -0.00713669 10.3874 0.000113962C10.8606 0.000113962 11.3331 0.0658095 11.7824 0.213912C14.5506 1.09811 15.5481 4.08227 14.7149 6.69065C14.2424 8.02357 13.4699 9.24008 12.4581 10.2341C11.0099 11.6119 9.42066 12.8351 7.70993 13.8887L7.52243 14L7.32744 13.8814C5.6107 12.8351 4.01247 11.6119 2.55074 10.2267C1.54575 9.23271 0.772504 8.02357 0.292509 6.69065C-0.554982 4.08227 0.442508 1.09811 3.24073 0.198439C3.45823 0.124756 3.68247 0.0731778 3.90747 0.0444414H3.99747C4.20822 0.0142314 4.41747 0.000113962 4.62746 0.000113962H4.70996ZM11.3924 2.32861C11.0849 2.22472 10.7474 2.38756 10.6349 2.69703C10.5299 3.0065 10.6949 3.34544 11.0099 3.45523C11.4906 3.63207 11.8124 4.09701 11.8124 4.61205V4.63489C11.7981 4.80363 11.8499 4.96646 11.9549 5.09173C12.0599 5.21699 12.2174 5.28993 12.3824 5.30541C12.6899 5.2973 12.9524 5.05488 12.9749 4.74468V4.657C12.9974 3.6247 12.3606 2.68966 11.3924 2.32861Z" fill="#FF4121" />
                                                </svg>
                                            </span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <div class="tp-header-toogle-wrapper d-xl-none">
                                    <button class="tp-header-toogle"><i class="far fa-bars"></i></button>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (false == $header_right_part_switch_setting) : ?>
                        <div class="col-xxl-9 col-xl-10 col-7 d-xl-none">
                            <div class="tp-header-action d-flex align-items-center justify-content-end">
                                <div class="tp-header-toogle-wrapper">
                                    <button class="tp-header-toogle"><i class="far fa-bars"></i></button>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>
    <!-- header end -->