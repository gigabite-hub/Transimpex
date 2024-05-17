"use strict";

(function ($) {

    $(document).ready(function () {

        console.log('ready');
        var currentURL = window.location.href;
        console.log(currentURL);


        $('.category-container a').on('click', function (event) {
            event.preventDefault(); // Prevent the default action of the link
            var slug = $(this).data('slug');
            console.log('Data Slug:', slug);

            $.ajax({
                url: TRANS.AJAX_URL,
                type: 'POST',
                data: {
                    'action': 'get_certificate_related_post',
                    'slug': slug,
                    'nonce': TRANS.NONCE,
                },
                beforeSend: function () {
                    $('.blog-wrapper').addClass('loading');
                }
            })
                .done(function (results) {
                    $('.recipes-wrap').html(results);
                    $('.blog-wrapper').removeClass('loading');
                    $('.green-button.all-blog').hide();
                });
        });







    });

}(jQuery));
