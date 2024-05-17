"use strict";

(function ($) {

    $(document).ready(function () {

        console.log('ready');
        var currentURL = window.location.href;
        console.log(currentURL);

        var lastScrollTop = 0;
        var delay = 300; // Delay in milliseconds (0.3s)

        $(window).on('scroll', function () {
            var currentScrollTop = $(this).scrollTop();
            var viewportWidth = $(window).width();

            if (currentScrollTop > lastScrollTop) {
                $('.header-bg').removeClass('scrolled header-controll');
            } else {
                if (viewportWidth > 768) {
                    setTimeout(function () {
                        $('.header-bg').addClass('scrolled');
                    }, delay);
                    $('.header-bg').addClass('header-controll');
                } else if (viewportWidth <= 768 && viewportWidth > 480) {
                    // No action needed for tablets
                }
            }

            lastScrollTop = currentScrollTop;

            if (currentScrollTop === 0) {
                setTimeout(function () {
                    $('.header-bg').removeClass('scrolled');
                }, delay);
                $('.header-bg').removeClass('header-controll');
            }
        });







    });

}(jQuery));
