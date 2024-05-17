"use strict";

(function ($) {

    $(document).ready(function () {

        console.log('ready');
        var currentURL = window.location.href;
        console.log(currentURL);


        $('.category-container a').on('click', function(event) {
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







    });

}(jQuery));
