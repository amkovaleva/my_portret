'use strict'

const form = $('#order-form');
const change_url = form.attr('change_action');
const price = $('#cost');
const validation = $('#validation');


const dropZone = $('#drop-zone')[0];
const img_container =  $('#image-content');
const upload_container = $('#upload-content');
const file_input = $('#cartitem-image')[0];

const reader = new FileReader();

let update_img = function (src){
    img_container.html('');
    const img = $('<img>').attr('src', src).attr('alt', img_container.attr('alt'));
    img_container.append(img);
    upload_container.hide();
    validation.hide();
};

if (window.FileList && window.File && dropZone) {
    dropZone.addEventListener('dragover', event => {
        event.stopPropagation();
        event.preventDefault();
        event.dataTransfer.dropEffect = 'copy';
    });

    dropZone.addEventListener('drop', event => {
        event.stopPropagation();
        event.preventDefault();
        const files = event.dataTransfer.files;
        //console.log(files);
        file_input.files = files;
        reader.readAsDataURL(files[0]);

        reader.addEventListener('load', (event) => {
            update_img(event.target.result);
        });
    });
}
else if (dropZone){
    dropZone.remove();
}

if(file_input)
    file_input.onchange = () => {
        const [file] = file_input.files
        if (file) {
            update_img(URL.createObjectURL(file));
        }
    };


let sendPost = function (url, callback) {
    $.post(url, form.serializeArray(), callback).fail(function () {
        console.log("error");
    });
};

let getElemByProp = function (field) {
    return $('#cartitem-' + field);
};
let getName = function (field) {
    return 'CartItem[' + field + ']';
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
        price.val(info.object.cost);
        $('#frame-content').attr('style', "background-image: url('" + info.object.frame_img + "');");

        init_change_action();
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

form.unbind('submit').bind('submit', (event) => {
    event.preventDefault();
    event.stopPropagation();

   if(event.isTrigger)
        return;

    if(!file_input.files.length){
        validation.show();
        return false;
    }

    let data = new FormData(form[0]), url = form.attr('action');

    $.ajax({
        url: url,
        type: 'post',
        data: data,
        cache: false,
        contentType: false,
        processData: false
    }).done(function (response) {
        if (response.success) {
            console.log("success");
        }
    }).fail(function () {
        console.log("error");
    });
});

init_change_action();



