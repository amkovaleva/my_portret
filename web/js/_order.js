'use strict'

let form;
let fileInput;
let default_img;

let sendPost = function (url, callback) {
    $.post(url, form.serializeArray(), callback).fail(function () {
        console.log("error");
    });
};

let change_callback = (event) => {
    //console.log('change_callback');
    let el = $(event.target);
    let field_type = el.attr('name').replace('CartItem[', '').replace(']', '');

    if(field_type === 'material_id')
        $('.materials__output').text($('.materials__tools-choice .materials__widget:checked ~ span').text());


    sendPost(form.attr('change_action') + field_type + '/' + el.val() + '/', (info) => {
        let render_info = info['render'];

        render_info.forEach(item => {
            let container = $(item['container']),
                new_container = $(item['html']);

            if(!container.length) {
                new_container.hide();
                $('.order__addons').before(new_container);
                new_container.slideDown();
                return;
            }

            if(!item['html'])
                container.slideUp('slow', function(){ container.remove(); });

            else if(item['field_index'] === 2) { // hide only paper option

                let is_visible_container = container.is(":visible");
                container.replaceWith(new_container);

                if(item['list'] === 1) {
                    if(is_visible_container)
                        new_container.show();
                    new_container.slideUp();
                }
                else{
                    new_container.hide();
                    new_container.slideDown();
                }
            }
            else
                container.replaceWith(item['html']);

        });

        init_change_action();
    });
};


let init_change_action = () => {

    init_colour_picker();
    init_select();

    let containers = ['materials__tools-choice', 'materials__surfaces-choice', 'order__portrait-size',
        'order__people', 'order__frame-size', 'order__frame-color', 'order__mat'];

    $('.' + containers.join(' input, .') + ' input').unbind('change', change_callback).bind('change', change_callback);

    updateTotal();
};


(function($) {

    form = $('#order-form');
    fileInput = $('#cartitem-image');
    default_img = $('.stage__portrait').attr('src');

    form.unbind('submit').bind('submit', (event) => {
        if (!fileInput[0].files.length) {
            event.preventDefault();
            event.stopPropagation();
            $('.shim').show()
            return false;
        }
    });
    init_change_action();

    $('.order__uploading-hint .upload').on('click', () => {
        fileInput.trigger('click');
    })

    if (fileInput.length)
        fileInput.on('change', () => {
            const [file] = fileInput[0].files
            if (file) {
                let is_valid_ext = ['jpeg', 'jpg', 'bmp', 'png'].includes(file.name.split('.').pop().toLowerCase());
                if(is_valid_ext)
                    $('.stage__portrait').attr('src', URL.createObjectURL(file));
                else {
                    fileInput.val('');
                    $('.stage__portrait').attr('src', default_img);
                }
            }
        });
})(jQuery);