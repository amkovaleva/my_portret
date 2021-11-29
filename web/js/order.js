'use strict'

const form = $('#order-form');
const change_url = form.attr('change_action');
const price = $('#cost');

let sendPost = function (url, callback) {
    $.post(url, form.serializeArray(), callback).fail(function () {
        console.log("error");
    });
};

let getElemByProp = function (field) {
    return $('#orderform-' + field);
};
let getName = function (field) {
    return 'OrderForm[' + field + ']';
};

let update_select_content = (updated_list, items, prompt, prop_name, object) => {
    updated_list.html('');

    if (prompt)
        updated_list.append($('<option>').text(prompt).attr('value', 0));

    for (let prop in items) {
        let op = $('<option>');
        op.attr('value', prop);
        op.text(items[prop]);
        updated_list.append(op);
    }
    updated_list.val(object[prop_name]);
};


let update_radio_content = (updated_list, prop_name, items, is_colour, object) => {

    updated_list.html('');

    for (let prop in items) {

        let input = $('<input>');
        input.attr('value', prop);
        input.attr('type', 'radio');
        input.attr('name', getName(prop_name));
        if (object[prop_name] == prop) {
            input.prop('checked', true)
        }

        let label = $('<label>')
        label.append(input);
        if (is_colour) {
            label.attr('class', 'round');
            label.attr('style', 'background: ' + items[prop]);
        } else {
            label.append(items[prop]);
        }
        updated_list.append(label);
    }
};


let change_callback = (event) => {
    let el = $(event.target);
    let field_type = (el.attr('changed-field') ? el : el.parents('[changed-field]')).attr('changed-field');

    sendPost(change_url + '/' + field_type + '/' + el.val(), (info) => {

        if (info.items) {
            info.items.forEach(item_info => {
                let updated_list = getElemByProp(item_info.id)
                if (item_info['type'] === 'select')
                    update_select_content(updated_list, item_info.items, item_info['prompt'], item_info.id, info.object);
                if (item_info['type'] === 'radio')
                    update_radio_content(updated_list, item_info.id, item_info.items, item_info.is_colour, info.object);

                if (!Object.entries(item_info.items).length)
                    updated_list.parent().hide();
                else
                    updated_list.parent().show();
            });
        }
        if (info.price) {
            price.val(info.price);
        }
        init_change_action();

        /* let frame = getElemByProp('frame_id').find('input:checked');
         if (!frame.length)
             return;
         let mount = getElemByProp('mount_id').find('input:checked'),
             is_mount = !!mount.length,
             url = is_mount ? 'mounts' : 'frames';

         url += is_mount ? 'mounts' : 'frames';

         let img = $('<img>').attr('src', '/uploads/' + url)
 */
    });
};


let change_active_in_group = (radio_group) => {
    radio_group.find('label').removeClass('active');
    radio_group.find('input:checked').parent('label').addClass('active');
};

let change_radio = (event) => {
    let radio_group = $(event.target).parents('[role=radiogroup]');
    change_active_in_group(radio_group);
};

let init_change_action = () => {
    $('select[changed-field], input[changed-field], [changed-field] input')
        .unbind('change', change_callback).bind('change', change_callback);

    $('[role=radiogroup] input')
        .unbind('change', change_radio).bind('change', change_radio);

    $('[role=radiogroup]').each((index, radio_group) => {
        change_active_in_group($(radio_group));
    });
};

init_change_action();

