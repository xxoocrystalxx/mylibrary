(function ($) {
    "use strict";

    /*=============================================
	=    		 Preloader			      =
=============================================*/
    function preloader() {
        $("#preloader").delay(0).fadeOut();
    }

    $(window).on("load", function () {
        preloader();
    });

    /*=============================================
	=    		Mobile Menu			      =
=============================================*/
    //SubMenu Dropdown Toggle
    if ($(".menu__area li.menu-item-has-children ul").length) {
        $(".menu__area .navigation li.menu-item-has-children").append(
            '<div class="dropdown__btn"><span class="fas fa-angle-down"></span></div>'
        );
    }

    //Mobile Nav Hide Show
    if ($(".mobile__menu").length) {
        var mobileMenuContent = $(".menu__area .main__menu").html();
        var userMenuContent = $("#userMenuContent").html();
        var divider = '<div class="dropdown-divider"></div>';

        // $(".mobile__menu .menu__box .menu__outer").append(mobileMenuContent);
        $(".mobile__menu .menu__box .menu__outer").append(
            userMenuContent,
            divider,
            mobileMenuContent
        );

        //Dropdown Button
        $(".mobile__menu li.menu-item-has-children .dropdown__btn").on(
            "click",
            function () {
                $(this).toggleClass("open");
                $(this).prev("ul").slideToggle(500);
            }
        );
        //Menu Toggle Btn
        $(".mobile__nav__toggler").on("click", function () {
            $("body").addClass("mobile-menu-visible");
        });

        //Menu Toggle Btn
        $(".menu__backdrop, .mobile__menu .close__btn").on(
            "click",
            function () {
                $("body").removeClass("mobile-menu-visible");
            }
        );
    }

    /*=============================================
	=     Menu sticky & Scroll to top      =
=============================================*/
    $(window).on("scroll", function () {
        var scroll = $(window).scrollTop();
        if (scroll < 245) {
            $("#sticky-header").removeClass("sticky-menu");
            $(".scroll-to-target").removeClass("open");
        } else {
            $("#sticky-header").addClass("sticky-menu");
            $(".scroll-to-target").addClass("open");
        }
    });

    /*=============================================
	=    		 Scroll Up  	         =
=============================================*/
    if ($(".scroll-to-target").length) {
        $(".scroll-to-target").on("click", function () {
            var target = $(this).attr("data-target");
            // animate
            $("html, body").animate(
                {
                    scrollTop: $(target).offset().top,
                },
                1000
            );
        });
    }

    /*=============================================
	=            Smooth Scroll              =
=============================================*/
    $(function () {
        $("a.scroll__link").on("click", function (event) {
            var $anchor = $(this);
            $("html, body")
                .stop()
                .animate(
                    {
                        scrollTop: $($anchor.attr("href")).offset().top - 40,
                    },
                    1000
                );
            event.preventDefault();
        });
    });
})(jQuery);
