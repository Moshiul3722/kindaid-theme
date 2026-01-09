<?php

/**
 * Header file
 * 
 * @package KindAid
 */

?>

<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>KindAid - Charity & Nonprofit HTML Template </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/logo/favicon.png">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <!--[if lte IE 9]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
      <![endif]-->

    <!-- Preloader Start -->
    <div class="preloader">
        <div class="loader"></div>
    </div>
    <!-- Preloader End -->

    <!-- back to top start -->
    <div class="back-to-top-wrapper">
        <button id="back_to_top" type="button" class="back-to-top-btn">
            <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11 6L6 1L1 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round" />
            </svg>
        </button>
    </div>
    <!-- back to top end -->

    <?php kindaid_header(); ?>


    <main>

        <!-- tp-breadcrumb-area-start -->
        <div class="tp-breadcrumb-area tp-breadcrumb-bg bg-position" data-img-bg="<?php echo get_template_directory_uri(); ?>/assets/img/breadcrumb/bg-3.jpg">
            <div class="container">
                <div class="tp-breadcrumb text-center position-relative z-index-2">
                    <h2 class="tp-breadcrumb-title lh-1 mb-10 wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".3s">Blog Details</h2>
                    <div class="tp-breadcrumb-list wow fadeInUp" data-wow-duration=".9s" data-wow-delay=".4s">
                        <span><a href="index.html">Home</a></span>
                        <span class="dvir">/</span>
                        <span class="active">Blog Details</span>
                    </div>
                    <div class="tp-breadcrumb-scroll pt-85">
                        <a href="#">
                            <svg width="20" height="29" viewBox="0 0 20 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 9.9541C1.00024 5.00348 5.03497 1 10 1C14.965 1 18.9998 5.00348 19 9.9541V19.0459C18.9998 23.9965 14.965 28 10 28C5.03497 28 1.00024 23.9965 1 19.0459L1 9.9541Z" stroke="white" stroke-opacity="0.1" stroke-width="2" />
                                <path class="upslide-1" d="M13 19.0455C13 17.398 11.6569 16.0625 10 16.0625C8.34315 16.0625 7 17.398 7 19.0455C7 20.6929 8.34315 22.0284 10 22.0284C11.6569 22.0284 13 20.6929 13 19.0455Z" fill="white" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- tp-breadcrumb-area-end -->