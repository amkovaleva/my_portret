(function($) {

    var selectValue;

    $('.select__handler').on('click', function () {
        if( ! $(this).parents('.select').hasClass('select--expanded') ){
            $('.select').removeClass('select--expanded');
            $(this).parents('.select').addClass('select--expanded');
        } else {
            $('.select').removeClass('select--expanded');
            $(this).parents('.select').removeClass('select--expanded');
        }
    });


    /* hide popup by overlay click ( goo.gl/SJG2Hw ) */

    $(document).on('click', function(event) {
        if (!$(event.target).closest('.select').length) {
            $('.select').removeClass('select--expanded');
        }
    });


    /* hide popup by Esc press */

    $(document).on('keyup', function(event) {
        if (event.keyCode === 27) {
            $('.select').removeClass('select--expanded');
        }
    });

    $('.select__item').on('click', function () {
        selectValue = $(this).html();
        $(this).parents('.select').find('.select__handler').html(selectValue);
        $(this).parents('.select').removeClass('select--expanded');
    });


})(jQuery);
