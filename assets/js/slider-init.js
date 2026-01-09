/***************************************************
==================== JS INDEX ======================
****************************************************
01. tp-causes-slider-active 
02. tp-hero-2-slider-active
03. tp-brand-2-slider-active
04. tp-testimonal-slider-active
05. tp-gallery-slider-active
06. tp-brand-3-slider-active
07. tp-causes-3-slider-active
08. tp-testimonal-3-slider-active
09. tp-postbox-gallery-active 
10. tp-brand-slider-active
****************************************************/


(function ($) {
	"use strict";

  //01. tp-causes-slider-active 
  var swiper = new Swiper(".tp-causes-slider-active", {
    slidesPerView: 4,
    spaceBetween: 0,
    loop: true,
    navigation: {
      prevEl: ".tp-causes-prev",
      nextEl: ".tp-causes-next",
    },
    breakpoints: {
      1400: {
        slidesPerView: 4,
      },
      1200: {
        slidesPerView: 3,
      },
      992: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 2,
      },
      576: {
        slidesPerView: 1,
      },
      0: {
        slidesPerView: 1,
      }
    },
  });

  //02. tp-hero-2-slider-active
  var swiper = new Swiper(".tp-hero-2-slider-active", {
    slidesPerView: 1,
    loop: true,
    autoplay: true,
    speed: 600,
    spaceBetween: 0,
    effect: 'fade',
    a11y: false,
    navigation: {
      prevEl: '.tp-hero-2-prev',
      nextEl: '.tp-hero-2-next',
    },
    autoplay: {
      delay: 6000,
      disableOnInteraction: false
    },
  });

  // 03. tp-brand-2-slider-active
  var swiper = new Swiper(".tp-brand-2-slider-active", {
		loop: true,
		freemode: true,
		slidesPerView: 'auto',
		centeredSlides: true,
		allowTouchMove: false,
		speed: 8000,
		autoplay: {
		  delay: 1,
		  disableOnInteraction: true,
		},
  });


  // 04. tp-testimonal-slider-active
  var swiper = new Swiper(".tp-testimonal-slider-active", {
    slidesPerView: 1,
    spaceBetween: 0,
    loop: true,
    navigation: {
      prevEl: ".tp-test-arrow-prev",
      nextEl: ".tp-test-arrow-next",
    },
  });

  // 05. tp-gallery-slider-active
  var swiper = new Swiper(".tp-gallery-slider-active", {
    slidesPerView: 4,
    spaceBetween: 20,
    loop: true,
    breakpoints: {
      1200: {
        slidesPerView: 4,
      },
      992: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 3,
      },
      576: {
        slidesPerView: 2,
      },
      0: {
        slidesPerView: 1,
      }
    },
  });

  // 06. tp-brand-3-slider-active
  var swiper = new Swiper(".tp-brand-3-slider-active", {
		loop: true,
		freemode: true,
		slidesPerView: 'auto',
		centeredSlides: true,
		allowTouchMove: false,
    spaceBetween: 15,
		speed: 8000,
		autoplay: {
		  delay: 1,
		  disableOnInteraction: true,
		},
  });


  //07. tp-causes-3-slider-active 
  var swiper = new Swiper(".tp-causes-3-slider-active", {
    slidesPerView: 3,
    spaceBetween: 24,
    loop: true,
    navigation: {
      prevEl: ".tp-causes-prev",
      nextEl: ".tp-causes-next",
    },
    breakpoints: {
      1200: {
        slidesPerView: 3,
      },
      992: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 2,
      },
      576: {
        slidesPerView: 1,
      },
      0: {
        slidesPerView: 1,
      }
    },
  });


  // 08. tp-testimonal-3-slider-active
  var swiper = new Swiper(".tp-testimonal-3-slider-active", {
    slidesPerView: 1,
    spaceBetween: 0,
    loop: true,
    pagination: {
      el: ".tp-testimonal-3-pagination",
    },
  });

  // 09. tp-postbox-gallery-active  
  var swiper = new Swiper(".tp-postbox-gallery-active", {
    slidesPerView: 1,
    spaceBetween: 0,
    loop: true,
    navigation: {
      prevEl: ".tp-gallery-arrow-prev",
      nextEl: ".tp-gallery-arrow-next",
    },
  });

  // 10. tp-brand-slider-active
  var swiper = new Swiper(".tp-brand-slider-active", {
    slidesPerView: 4,
    spaceBetween: 15,
    loop: true,
    breakpoints: {
      1200: {
        slidesPerView: 5,
      },
      992: {
        slidesPerView: 4,
      },
      768: {
        slidesPerView: 3,
      },
      576: {
        slidesPerView: 2,
      },
      0: {
        slidesPerView: 2,
      }
    },
  });

})(jQuery);    