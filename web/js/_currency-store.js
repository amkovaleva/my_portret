(function($) {

    $('.currency__widget').on('change', function () {
        let new_currency = $('.currency__widget:checked').val();
        $('.store__value').each(function() {
            let price_elem = $( this );
            price_elem.text(price_elem.data( new_currency));
        });
    });
})(jQuery);
