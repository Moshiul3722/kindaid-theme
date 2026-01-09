 <?php

    /**
     * Offcanvas
     * 
     * @package KindAid
     */

    $offcanvas_logo = get_theme_mod('offcanvas_logo', get_template_directory_uri() . '/assets/img/logo/logo.png');
    $offcanvas_title = get_theme_mod('offcanvas_title', __('Hello There!', 'kindaid'));
    $offcanvas_description = get_theme_mod('offcanvas_description');
    $offcanvas_images = get_theme_mod('offcanvas_gallery');
    $offcanvas_information_title = get_theme_mod('offcanvas_information_title', __('Informations', 'kindaid'));
    $offcanvas_informations = get_theme_mod('offcanvas_informations');
    $offcanvas_follows = get_theme_mod('offcanvas_follows');

    ?>
 <div class="tp-offcanvas">
     <div class="tp-offcanvas-header mb-50">
         <div class="tp-offcanvas-logo">
             <a href="index.html"><img data-width="108" src="<?php echo esc_url($offcanvas_logo); ?>" alt=""></a>
         </div>
         <div class="tp-offcanvas-close">
             <button class="tp-offcanvas-close-button"><i class="fal fa-times"></i></button>
         </div>
     </div>
     <div class="tp-offcanvas-menu mb-50">
         <nav>
         </nav>
     </div>
     <div class="tp-offcanvas-content mb-40">
         <h3 class="tp-offcanvas-title"> <?php echo esc_html($offcanvas_title); ?></h3>
         <p><?php echo esc_html($offcanvas_description) ?></p>
     </div>

     <?php if ($offcanvas_images): ?>
         <div class="tp-offcanvas-gallery mb-50">

             <?php foreach ($offcanvas_images as $offcanvas_image) : ?>
                 <a class="popup-image" href="<?php echo esc_url($offcanvas_image['image']) ?>"><img src="<?php echo $offcanvas_image['image'] ?>" alt=""></a>
             <?php endforeach; ?>

         </div>
     <?php endif; ?>

     <?php if ($offcanvas_informations): ?>
         <div class="tp-offcanvas-info mb-50">
             <h3 class="tp-offcanvas-title"><?php echo esc_html__($offcanvas_information_title, 'kindaid') ?></h3>

             <?php foreach ($offcanvas_informations as $information) : ?>
                 <span><a href="<?php echo esc_url($information['info_link']) ?>"><?php echo esc_html($information['info_text']) ?></a></span>
             <?php endforeach; ?>

         </div>
     <?php endif; ?>

     <?php
        $offcanvas_follows_fb = get_theme_mod('offcanvas_follows_fb');
        $offcanvas_follows_twiter = get_theme_mod('offcanvas_follows_twiter');
        $offcanvas_follows_instagram = get_theme_mod('offcanvas_follows_instagram');

        ?>

     <div class="tp-offcanvas-social">
         <h3 class="tp-offcanvas-title"> <?php echo esc_html__($offcanvas_follows, 'kindaid') ?></h3>
         <?php if ($offcanvas_follows_fb): ?>
             <a href="<?php echo esc_url($offcanvas_follows_fb) ?>">
                 <svg xmlns="http://www.w3.org/2000/svg" width="12" height="18" viewBox="0 0 12 18" fill="none">
                     <path fill-rule="evenodd" clip-rule="evenodd" d="M1.62839 7.77713C0.911363 7.77713 0.761719 7.91782 0.761719 8.59194V9.81416C0.761719 10.4883 0.911363 10.629 1.62839 10.629H3.36172V15.5179C3.36172 16.192 3.51136 16.3327 4.22839 16.3327H5.96172C6.67874 16.3327 6.82839 16.192 6.82839 15.5179V10.629H8.77466C9.31846 10.629 9.45859 10.5296 9.60798 10.038L9.97941 8.81579C10.2353 7.97368 10.0776 7.77713 9.14609 7.77713H6.82839V5.74009C6.82839 5.29008 7.21641 4.92527 7.69505 4.92527H10.1617C10.8787 4.92527 11.0284 4.78458 11.0284 4.11046V2.48083C11.0284 1.80671 10.8787 1.66602 10.1617 1.66602H7.69505C5.30182 1.66602 3.36172 3.49004 3.36172 5.74009V7.77713H1.62839Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"></path>
                 </svg>
             </a>
         <?php endif; ?>
         <?php if ($offcanvas_follows_twiter): ?>
             <a href="<?php echo esc_url($offcanvas_follows_twiter) ?>">
                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14" viewBox="0 0 16 14" fill="none">
                     <path fill-rule="evenodd" clip-rule="evenodd" d="M5.28884 0.714844H0.666992L6.14691 7.9153L1.01754 13.9556H3.38746L7.26697 9.38713L10.7118 13.9136H15.3337L9.69453 6.50391L9.70451 6.51669L14.5599 0.798959H12.19L8.58427 5.04503L5.28884 0.714844ZM3.21817 1.97588H4.65702L12.7825 12.6525H11.3436L3.21817 1.97588Z" fill="currentColor"></path>
                 </svg>
             </a>
         <?php endif; ?>
         <?php if ($offcanvas_follows_instagram): ?>
             <a href="<?php echo esc_url($offcanvas_follows_instagram) ?>">
                 <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <path d="M1.66602 8.99935C1.66602 5.54238 1.66602 3.8139 2.73996 2.73996C3.8139 1.66602 5.54238 1.66602 8.99935 1.66602C12.4563 1.66602 14.1848 1.66602 15.2587 2.73996C16.3327 3.8139 16.3327 5.54238 16.3327 8.99935C16.3327 12.4563 16.3327 14.1848 15.2587 15.2587C14.1848 16.3327 12.4563 16.3327 8.99935 16.3327C5.54238 16.3327 3.8139 16.3327 2.73996 15.2587C1.66602 14.1848 1.66602 12.4563 1.66602 8.99935Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"></path>
                     <path d="M12.4747 9.00103C12.4747 10.9195 10.9195 12.4747 9.00103 12.4747C7.08256 12.4747 5.52734 10.9195 5.52734 9.00103C5.52734 7.08256 7.08256 5.52734 9.00103 5.52734C10.9195 5.52734 12.4747 7.08256 12.4747 9.00103Z" stroke="currentColor" stroke-width="1.5"></path>
                     <path d="M13.251 4.75391L13.242 4.75391" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                 </svg>
             </a>
         <?php endif; ?>
     </div>
 </div>
 <div class="tp-offcanvas-overlay"></div>