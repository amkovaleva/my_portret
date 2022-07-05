'use strict'

function updateTotal(){

    if(!$('#order-form').length)
        return;

    let sub_totals = [$('.order__people .select__handler .row__amount').text().trim()];
    $('.order__addons .choice__widget:checked').each((index,input) => {
        sub_totals.push($(input).parents('.choice--checkbox').find('.choice__price').text().trim());
    });

    let total = sub_totals.map(item => item.replace(/[^0-9]/g, '')).reduce((sum, current) => +sum + +current),
        template = sub_totals[0],
        res = '';

    if(isNaN(template[0] * 1))
        res += template[0];

    res += total.toLocaleString('en-US', {style: 'decimal'});

    if(isNaN(template[template.length - 1] * 1))
        res += template[template.length - 1];

    $('.order__total-price span').text(res);
}

(function($) {

    $('.currency__widget').on('change', function () {
        let new_currency = $('.currency__widget:checked').val();

        $('[data-ru]').each(function() {

            let price_elem = $( this );
            price_elem.text(price_elem.data( new_currency));

            updateTotal();
        });
    });

    $('.order__addons .choice__widget').on('change', function () {
        updateTotal();
    });
})(jQuery);

