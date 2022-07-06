
function init_colour_picker(){
    $('.color-picker__widget').unbind('change').on('change', function () {
        let colorPickerValue = $(this).parents('.color-picker__item').find('.color-picker__label').html();
        $(this).parents('.color-picker').find('.color-picker__output').html(colorPickerValue);
    });
}

(function($) {

    init_colour_picker()

})(jQuery);
