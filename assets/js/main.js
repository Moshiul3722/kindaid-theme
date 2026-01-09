/***************************************************
==================== JS INDEX ======================
****************************************************
01. PreLoader Js
02. Nice Select Js
03. mobile menu Js
04. Sticky Header Js
05. offcanvas
06. Search Js
07. Common Js
08. Smooth Scroll Js
09. back-to-top
10. magnificPopup img view
11. Counter Js
12. Parallax Js	
13. Wow Js	
14. slider-range
15. tp_ecommerce
****************************************************/

(function ($) {
	"use strict";

	var windowOn = $(window);
	
	////////////////////////////////////////////////////
	// 01. PreLoader Js
	windowOn.on('load', function () {
		$(".preloader").fadeOut(500);
	});

	// 02. Nice Select Js
	$('.tp-select').niceSelect();

	////////////////////////////////////////////////////
	// 03. mobile menu Js
    let tpMenuHTML = $('.tp-mobile-menu-active > ul').clone();
    let tpOffcanvasMenu = $('.tp-offcanvas-menu > nav');

    tpOffcanvasMenu.append(tpMenuHTML);

    if($(tpOffcanvasMenu).find('.sub-menu').length != 0){
      $(tpOffcanvasMenu).find('.sub-menu').parent().append('<button class="tp-sidemenu-close"><i class="fas fa-chevron-right"></i></button>');
    }
    
    let tpSideMenuToggle = $('button.tp-sidemenu-close');

    $(tpSideMenuToggle).on('click',function(){
        $(this).siblings('.sub-menu').slideToggle();
        $(this).parent().toggleClass('active');
    });



	///////////////////////////////////////////////////
	// 04. Sticky Header Js
	$(window).on('scroll', function () {
		let scroll = $(window).scrollTop();
		if (scroll < 20) {
			$("#header-sticky").removeClass("header-sticky");
		} else {
			$("#header-sticky").addClass("header-sticky");
		}
	});

	if ($('.tp-header-height').length > 0) {
        var headerHeight = document.querySelector(".tp-header-height");
        var setHeaderHeight = headerHeight.offsetHeight;

        $(".tp-header-height").each(function () {
            $(this).css({
                'height': setHeaderHeight + 'px'
            });
        });
    }

	////////////////////////////////////////////////////
	// 05. offcanvas

    $(".tp-header-toogle").on('click',function(){
        $(".tp-offcanvas").addClass("tp-offcanvas-open");
        $(".tp-offcanvas-overlay").addClass("tp-offcanvas-overlay-open");
    });

    $(".tp-offcanvas-close-button,.tp-offcanvas-overlay").on('click',function(){
        $(".tp-offcanvas").removeClass("tp-offcanvas-open");
        $(".tp-offcanvas-overlay").removeClass("tp-offcanvas-overlay-open");
    });

	$(".cartmini-open-btn").on("click", function () {
		$(".cartmini__area").addClass("cartmini-opened");
		$(".tp-offcanvas-overlay").addClass("tp-offcanvas-overlay-open");
	});

	$(".cartmini-close-btn, .tp-offcanvas-overlay").on("click", function () {
		$(".cartmini__area").removeClass("cartmini-opened");
		$(".tp-offcanvas-overlay").removeClass("tp-offcanvas-overlay-open");
	});


	////////////////////////////////////////////////////
	// 06. Search Js

	$(".tp-search-click").on("click", function () {
		$(".tp-search-form-toggle").addClass("active");
		$(".tp-offcanvas-overlay").addClass("tp-offcanvas-overlay-open");
	});

	$(".tp-search-close,.tp-offcanvas-overlay").on("click", function () {
		$(".tp-search-form-toggle").removeClass("active");
		$(".tp-offcanvas-overlay").removeClass("tp-offcanvas-overlay-open");
	});


	////////////////////////////////////////////////////
	// 07. Common Js
	$("[data-img-bg").each(function () {
		$(this).css("background-image", "url( " + $(this).attr("data-img-bg") + "  )");
	});

	$("[data-width]").each(function () {
		$(this).css("width", $(this).attr("data-width"));
	});

	$("[data-bg-color]").each(function () {
		$(this).css("background-color", $(this).attr("data-bg-color"));
	});
    $("[data-color]").each(function () {
        $(this).css("color", $(this).attr("data-color"))
    })
    $('.tp-faq-button').on('click', function() {
        $('.tp-faq-item').removeClass('active');
        $(this).closest('.tp-faq-item').addClass('active');
    });

	////////////////////////////////////////////////////
	// 09. back-to-top
    function back_to_top() {
        var $btn = $('#back_to_top'),
            $btnWrapper = $('.back-to-top-wrapper'),
            $window = $(window);
        $window.on('scroll', function () {
            if ($window.scrollTop() > 300) {
                $btnWrapper.addClass('back-to-top-btn-show');
            } else {
                $btnWrapper.removeClass('back-to-top-btn-show');
            }
        });

        $btn.on('click', function (e) {
            e.preventDefault();
            $('html, body').animate({ scrollTop: 0 }, 300);
        });
    }
    // Initialize
    back_to_top();

	////////////////////////////////////////////////////
	// 10. magnificPopup img view
	$('.popup-image').magnificPopup({
		type: 'image',
		gallery: {
			enabled: true
		}
	});

	$(".popup-video").magnificPopup({
		type: "iframe",
	});

	////////////////////////////////////////////////////
	// 11. Counter Js
	new PureCounter();
	new PureCounter({
		filesizing: true,
		selector: ".filesizecount",
		pulse: 2,
	});


	////////////////////////////////////////////////////
	// 12. Parallax Js	  
	if ($('.scene').length > 0) {
		$('.scene').parallax({
			scalarX: 5.0,
			scalarY: 5.0,
		});
	};
	if ($('.scene-y').length > 0) {
		$('.scene-y').parallax({
			scalarY: 5.0,
			scalarX: 0,
		});
	};

	////////////////////////////////////////////////////
	// 13. Wow Js
	new WOW().init();

	////////////////////////////////////////////////////
	// 14. slider-range

	$("#slider-range").slider({
		range: true,
		min: 0,
		max: 500,
		values: [75, 300],
		slide: function (event, ui) {
			$("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
		}
	});
	$("#amount").val("$" + $("#slider-range").slider("values", 0) +
		" - $" + $("#slider-range").slider("values", 1));

	$("#slider-range-offcanvas").slider({
		range: true,
		min: 0,
		max: 500,
		values: [75, 300],
		slide: function (event, ui) {
			$("#amount-offcanvas").val("$" + ui.values[0] + " - $" + ui.values[1]);
		}
	});
	$("#amount-offcanvas").val("$" + $("#slider-range-offcanvas").slider("values", 0) +
		" - $" + $("#slider-range-offcanvas").slider("values", 1));


	////////////////////////////////////////////////////
	// 15. tp_ecommerce
	function tp_ecommerce() {
		$('.tp-cart-minus').on('click', function () {
			var $input = $(this).parent().find('input');
			var count = parseInt($input.val()) - 1;
			count = count < 1 ? 1 : count;
			$input.val(count);
			$input.change();
			return false;
		});
	
		$('.tp-cart-plus').on('click', function () {
			var $input = $(this).parent().find('input');
			$input.val(parseInt($input.val()) + 1);
			$input.change();
			return false;
		});
	
		//  tpReturnCustomerLoginForm //
		$('.tp-checkout-login-form-reveal-btn').on('click', function () {
			$('#tpReturnCustomerLoginForm').slideToggle(400);
		});
	
		//  Show Coupon Toggle Js //
		$('.tp-checkout-coupon-form-reveal-btn').on('click', function () {
			$('#tpCheckoutCouponForm').slideToggle(400);
		});

		// Create An Account Toggle Js //
		$('#cbox').on('click', function () {
			$('#cbox_info').slideToggle(900);
		});
		
		// Shipping Box Toggle Js //
		$('#ship-box').on('click', function () {
			$('#ship-box-info').slideToggle(1000);
		});
	}
	tp_ecommerce();

})(jQuery);