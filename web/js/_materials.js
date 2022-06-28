(function($) {

    $('[name="CartItem[material_id]"]').on('change', function () {
        if( $(this).val() == 2) {
            $('.materials__output').html('Oil');
            $('.materials__surfaces-choice').slideDown();
        }
        if( $(this).val() == 1) {
            $('.materials__output').html('Pencil');
            $('.materials__surfaces-choice').slideUp();
        }
    });

})(jQuery);
