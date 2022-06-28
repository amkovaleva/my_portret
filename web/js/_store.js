(function($) {

    $('.store__preview').on('click', function (event) {
        if (window.matchMedia('(max-width: 899px)').matches) {
            $('.store__preview').not( $(this) ).removeClass('store__preview--expanded');
            if( ! $(this).hasClass('store__preview--expanded') ) {
                $(this).addClass('store__preview--expanded');
                event.preventDefault();
            }
        }
    });

    $(document).on('click', function(event) {
        if (window.matchMedia('(max-width: 899px)').matches) {
            if (!$(event.target).closest('.store__preview').length) {
                $('.store__preview').removeClass('store__preview--expanded')
            }
        }
    });

})(jQuery);
