'use strict'

const form = $('#order-form');
const validation = $('#validation');

let getElemByProp = function (field) {
    return $('#cartitem-' + field);
};
let getName = function (field) {
    return 'CartItem[' + field + ']';
};
let getFormatID = function () {
    return getElemByProp('format_id').val();
};

//<editor-fold desc="Image actions">

const dropZone = document.getElementById('drop-zone');
const fileInput = getElemByProp('image')[0];
const uploadContainer = $('#upload-content');
const frameContainer = $('#frame-content');

const modal = $('#crop-modal');
const crop_container = modal.find('.modal-body');
const originImage = modal.find('img');
let cropData, cropper, sideSizes;
let isPortraitOrientation = true;

const reader = new FileReader();

let setUpFormat = function (format_id) {
    let format = window.frameSizes[format_id];
    sideSizes = [1 * format.length, 1 * format.width];
};

let loadPhoto = function (src) {
    originImage.attr('src', src);
    modal.modal();
    uploadContainer.hide();
    validation.hide();
    frameContainer.addClass('with-image').removeClass('no-image');
};

$('#clear').click(() => {
    fileInput.value = null;
    originImage.attr('src', '');
    let img = frameContainer.find('img.photo');
    if (img.length) {
        img.remove();
    }
    uploadContainer.show();
    frameContainer.removeClass('with-image').addClass('no-image');
});
let changeArea = function () {
    if (fileInput.value) {
        modal.modal();
    }
};

$('#change-orientation').click(() => {
    isPortraitOrientation = !isPortraitOrientation;
    let frame_img = frameContainer.find('img.frame');
    let cur_src = frame_img.attr('src'),
        old_str = isPortraitOrientation ? '_r.svg' : '.svg',
        new_str = isPortraitOrientation ? '.svg' : '_r.svg';

    frame_img.on('load', changeArea);
    frame_img.attr('src', cur_src.replace(old_str, new_str));
});

$('#change-area').click(changeArea);

let drowBaseImage = function (left, top, canvas_w = null, canvas_h = null) {

    console.log(left, top, canvas_w, canvas_h);
    let canvas = $('<canvas>').attr('width', canvas_w ? canvas_w : cropData.width).attr('height', canvas_h ? canvas_h : cropData.height)[0],
        ctx = canvas.getContext("2d");

    ctx.drawImage(originImage[0], cropData.x, cropData.y, cropData.width, cropData.height, left, top, cropData.width, cropData.height);
    return [ctx, canvas]
}

let combineImages = function () {

    let frame_id = getElemByProp('frame_id').find('input:checked').val(),
        res_img = frameContainer.find('img.result');

    if (!res_img.length) {
        res_img = $('<img>').addClass('result');
        frameContainer.prepend(res_img);
    }

    if (!frame_id) {
        let [ctx, canvas] = drowBaseImage(0, 0);
        res_img.attr('src', canvas.toDataURL());
        return;
    }


    let frame_img = new Image();
    frame_img.onload = function () {
        let p_h = isPortraitOrientation ? sideSizes[0] : sideSizes[1],
            p_w = isPortraitOrientation ? sideSizes[1] : sideSizes[0],
            f_w = window.frameInfos[frame_id].width * 1,
            mount_id = getElemByProp('mount_id').find('input:checked').val(),
            m_w = mount_id ? window.mountInfos[mount_id][isPortraitOrientation ? 'add_width' : 'add_length'] * 1 : 0,
            m_h = mount_id ? window.mountInfos[mount_id][isPortraitOrientation ? 'add_length' : 'add_width'] * 1 : 0,
            scale = cropData.width / p_w,
            width = Math.round((p_w + 2 * (f_w + m_w) - 1) * scale),
            height = Math.round((p_h + 2 * (f_w + m_h) - 1) * scale),
            top = Math.round((height - cropData.height) / 2),
            left = Math.round((width - cropData.width) / 2);

        let [ctx, canvas] = drowBaseImage(top, left, width, height);
        ctx.drawImage(frame_img, 0, 0, frame_img.width, frame_img.height, 0, 0, width, height);
        res_img.attr('src', canvas.toDataURL());
    };
    frame_img.src = frameContainer.find('img.frame').attr('src');

};

modal.on('shown.bs.modal', function () {
    crop_container.height(originImage.height());
    crop_container.width(originImage.width());
    let ratio = isPortraitOrientation ? sideSizes[1] / sideSizes[0] : sideSizes[0] / sideSizes[1];
    originImage.cropper({aspectRatio: ratio});
    cropper = originImage.data('cropper');
    cropper.setAspectRatio(ratio);
    cropper.init();
}).on('hidden.bs.modal', function () {
    cropData = cropper.getData();
    combineImages();
    cropper.destroy();
});

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
        fileInput.files = files;
        reader.readAsDataURL(files[0]);

        reader.addEventListener('load', (event) => {
            loadPhoto(event.target.result);
        });
    });
} else if (dropZone) {
    dropZone.remove();
}

if (fileInput)
    fileInput.onchange = () => {
        const [file] = fileInput.files
        if (file) {
            loadPhoto(URL.createObjectURL(file));
        }
    };
//</editor-fold>

//<editor-fold desc="Form actions">

let sendPost = function (url, callback) {
    $.post(url, form.serializeArray(), callback).fail(function () {
        console.log("error");
    });
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

    sendPost(form.attr('change_action') + field_type + '/' + el.val() + '/', (info) => {

        let format_id = getFormatID();
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
        $('#cost').val(info.object.cost);

        frameContainer.attr('style', "background-image: url('" + info.object.frame_img + "');");


        init_change_action();

        let new_format_id = getFormatID();
        if (format_id !== new_format_id)
            setUpFormat(new_format_id);
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

    if (event.isTrigger)
        return;

    if (!fileInput.files.length) {
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


//</editor-fold>

init_change_action();