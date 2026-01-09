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
    <header>
        <div id="header-sticky" class="tp-header-area tp-header-2-style tp-header-3-style tp-header-lg-spacing tp-transparent tp-header-blur">
            <div class="container-fluid container-1790">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-5">
                        <div class="tp-header-logo">
                            <?php theme_header_logo(); ?>
                        </div>
                    </div>
                    <div class="col-lg-10 col-7">
                        <div class="d-flex justify-content-end">
                            <div class="tp-main-menu text-center mr-60 d-none d-xl-block">
                                <nav class="tp-mobile-menu-active">
                                    <?php kindaid_main_menu(); ?>
                                </nav>
                            </div>
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
                                <div class="tp-header-toogle-wrapper d-xl-none">
                                    <button class="tp-header-toogle"><i class="far fa-bars"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header end -->