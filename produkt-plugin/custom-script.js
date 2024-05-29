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

        // JavaScript
        const $hamburgerMenu = $('.hamburger-menu');
        const $flyoutMenu = $('.mobile-flyout-menu');
        const $flyoutItem = $('.flyout-item-close');

        // Toggle flyout menu visibility
        $hamburgerMenu.on('click', function () {
            const isHidden = $flyoutMenu.attr('aria-hidden') === 'true';
            $flyoutMenu.attr('aria-hidden', !isHidden);
        });

        // Collapse flyout menu on item click
        $flyoutItem.on('click', function () {
            $flyoutMenu.attr('aria-hidden', true);
        });

        // Toggle submenus on arrow click
        $('.flyout-menu .menu-item-has-children > .submenu-toggle').click(function (e) {
            e.preventDefault();
            var $submenu = $(this).siblings('.sub-menu');

            if ($submenu.is(':visible')) {
                $submenu.slideUp();
                $(this).parent('.menu-item-has-children').removeClass('open');
            } else {
                $('.flyout-menu .sub-menu').slideUp();
                $('.flyout-menu .menu-item-has-children').removeClass('open');
                $submenu.slideDown();
                $(this).parent('.menu-item-has-children').addClass('open');
            }
        });


        function toggleStickyHeader() {
            if ($(window).scrollTop() > 100) {
                $('.custom-header').addClass('sticky');
            } else {
                $('.custom-header').removeClass('sticky');
            }
        }


        toggleStickyHeader();

        $(window).scroll(function () {
            toggleStickyHeader();
        });

    });

}(jQuery));
