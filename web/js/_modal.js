(function($) {

    $('.modal__close').on('click', function(event) {
       $(this).parents('.shim').remove();
    });

})(jQuery);
