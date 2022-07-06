'use strict'

const form = $('#order-form');

let sendPost = function (url, callback) {
    $.post(url, form.serializeArray(), callback).fail(function () {
        console.log("error");
    });
};

let change_callback = (event) => {
    console.log('change_callback');
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

                container.replaceWith(new_container);

                if(item['list'] === 1) {
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

form.unbind('submit').bind('submit', (event) => {
    event.preventDefault();
    event.stopPropagation();
});

init_change_action();