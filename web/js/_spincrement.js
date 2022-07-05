(function($) {

    var defaultOptions = {
        from: 10,
        to: 100,
        duration: 2500, // ms; TOTAL length animation
        leeway: 300, // percent of duration
        easing: 'spincrementEasing',
        fade: true
    }


    /* spincrement for "About" */

    var aboutElements = $('.about__counter--spincrement');
    if(! $('.about__counter--spincrement').length)
        return;

    var aboutCoordinate = aboutElements.first().offset().top - $(window).outerHeight();

    function watchAbout() {
        if ($(this).scrollTop() > aboutCoordinate) {
            aboutElements.spincrement(defaultOptions);
            $(window).off('DOMContentLoaded', watchAbout);
            $(window).off('scroll', watchAbout);
        }
    }

    $(window).on('DOMContentLoaded', watchAbout);
    $(window).on('scroll', watchAbout);

})(jQuery);
