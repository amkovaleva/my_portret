
function init_select(){

    $('.select__handler').unbind('click').on('click', function () {
        if( ! $(this).parents('.select').hasClass('select--expanded') ){
            $('.select').removeClass('select--expanded');
            $(this).parents('.select').addClass('select--expanded');
        } else {
            $('.select').removeClass('select--expanded');
            $(this).parents('.select').removeClass('select--expanded');
        }
    });

    $('.select__item').unbind('click').on('click', function () {
        let curElem = $(this),
            select =  curElem.parents('.select');

        select.find('.select__handler').html( curElem.html());
        select.removeClass('select--expanded');

        let input = select.prev( "input" ),
            oldValue = input.val();

        if(oldValue == curElem.data("id"))
            return;

        input.val(curElem.data("id"));
        input.trigger('change');
    });
}

(function($) {




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

    init_select();

})(jQuery);
