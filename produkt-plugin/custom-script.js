"use strict";

(function ($) {

    $(document).ready(function () {

        console.log('ready');
        var currentURL = window.location.href;
        console.log(currentURL);


        $('.category-container a').on('click', function (event) {
            event.preventDefault();
            var zertifikatSlug = $(this).data('slug');
            var categorySlug = $('#category-slug').val();

            $.ajax({
                url: FHWS.AJAX_URL,
                type: 'POST',
                data: {
                    'action': 'fetch_related_posts',
                    'zertifikatSlug': zertifikatSlug,
                    'categorySlug': categorySlug,
                    'nonce': FHWS.NONCE,
                },
                beforeSend: function () {
                    $('.transimpex-related-pots').addClass('loading');

                }
            }).done(function (results) {
                $('.transimpex-related-pots').html(results);
                $('.transimpex-related-pots').removeClass('loading');

            });
        });

        $('.transimpex-nav .wp-block-navigation-submenu:nth-child(3)').hide(); // Hide all submenus by default

        $('.main-menu .menu > li').hover(function () {
            $(this).children('ul').stop(true, true).slideDown(200);
        }, function () {
            $(this).children('ul').stop(true, true).slideUp(200);
        });

        // For touch devices
        $('.main-menu .menu > li:has(ul) > a').on('click touchend', function (e) {
            var $li = $(this).parent();
            if (!$li.hasClass('hover')) {
                e.preventDefault();
                $li.addClass('hover');
            }
        });

        $(document).on('click touchend', function (e) {
            if (!$(e.target).closest('.main-menu').length) {
                $('.main-menu .menu > li.hover').removeClass('hover');
            }
        });

        $('.search-icon').on('click', function () {
            $('.search-bar').toggle();
        });

        $('.search-field').on('keypress', function (e) {
            if (e.which === 13) { // Enter key
                $(this).closest('form').submit();
            }
        });

        // $('.transimpex-nav .open-on-hover-click').on('click', function (e) {
        //     e.preventDefault();
        //     var $submenu = $(this).siblings('.wp-block-navigation-submenu');
        //     $('.transimpex-nav .wp-block-navigation-submenu').not($submenu).slideUp(); // Close other submenus
        //     $submenu.slideToggle();
        //     $('.transimpex-nav .open-on-hover-click').not($(this)).removeClass('expanded'); // Remove 'expanded' class from other menu items
        //     $(this).toggleClass('expanded');
        // });

    });

}(jQuery));
