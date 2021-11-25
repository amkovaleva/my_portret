'use strict'

const form = $('#order-form');
const change_url = form.attr('change_action');
const price = $('#cost');

let sendPost = function (url, callback) {
    $.post(url, form.serializeArray(), callback).fail(function () {
        console.log("error");
    });
};
let update_select_content = function (prop_name, items, prompt) {
    let updated_list = $('#orderform-' + prop_name)
    updated_list.html('');
    if(prompt)
        updated_list.append($('<option>').text(prompt));

    for (let prop in items) {
        let op = $('<option>');
        op.attr('value', prop);
        op.text(items[prop]);
        updated_list.append(op);
    }
};


let change_callback = (event) => {
    let el = $(event.target);
    let field_type = (el.attr('changed-field') ? el : el.parents('[changed-field]')).attr('changed-field');

    sendPost(change_url + '/' + field_type + '/' + el.val(), (info) => {

        if (info.items) {
            info.items.forEach(item_info => {
                if (item_info['type'] === 'select')
                    update_select_content(item_info.id, item_info.items, item_info['prompt']);
            });
        }
        if (info.price) {
            price.val(info.price);
        }
    });
};
$('select[changed-field], input[changed-field], [changed-field] input').unbind('change', change_callback).bind('change', change_callback);


