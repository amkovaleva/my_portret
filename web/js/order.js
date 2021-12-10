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
let resultImage = null;
const frameImage = frameContainer.find('img.frame');

const modal = $('#crop-modal');
const crop_container = modal.find('.modal-body');
const originImage = modal.find('img');
let cropData, cropper, sideSizes;
let isPortraitOrientation = true;

const reader = new FileReader();

let setUpFormat = function () {
    let format = window.frameSizes[getFormatID()];
    sideSizes = [1 * format.length, 1 * format.width];
};

let setFrameURL = function (url = null) {
    if (url === null)
        url = frameImage.attr('src');

    if (!url) {
        frameImage.hide();
        frameContainer.removeClass('with-frame').addClass('no-frame');
    }
    else {
        frameImage.show();
        frameContainer.addClass('with-frame').removeClass('no-frame');
    }

    let old_str = isPortraitOrientation ? '_r.svg' : '.svg',
        new_str = isPortraitOrientation ? '.svg' : '_r.svg';
    frameImage.attr('src', url.replace(old_str, new_str));
};

let loadPhoto = function (src) {
    originImage.on('load', () => {
        modal.modal();
    })
    originImage.attr('src', src);
};

$('#clear').click(() => {
    fileInput.value = null;
    originImage.attr('src', '');
    if (resultImage)
        resultImage.remove();
    resultImage = null;
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
    setFrameURL();
    changeArea();
});


$('#change-area').click(changeArea);

let updatePhotoPosition = function () {
    let frame_format_id = getElemByProp('frame_format_id').val();
    if (!frame_format_id || !resultImage) {
        return;
    }

    let frame_id = getElemByProp('frame_id').find('input:checked').val(),
        f_w = frame_id ? window.frameInfos[frame_id].width * 1 - 0.7 : 0,
        p_h = isPortraitOrientation ? sideSizes[0] : sideSizes[1],
        p_w = isPortraitOrientation ? sideSizes[1] : sideSizes[0],

        frame_format = window.frameSizes[frame_format_id],
        frame_sideSizes = [1 * frame_format.length, 1 * frame_format.width],
        f_f_h = isPortraitOrientation ? frame_sideSizes[0] : frame_sideSizes[1],
        f_f_w = isPortraitOrientation ? frame_sideSizes[1] : frame_sideSizes[0],

        total_width = f_f_w + 2 * f_w,
        total_height = f_f_h + 2 * f_w,
        width = p_w * 100 / total_width,
        height = p_h * 100 / total_height,
        top = Math.floor((100 - height) / 2),
        left = Math.floor((100 - width) / 2);

    resultImage.attr('style',
        'width: ' + Math.ceil(width) + '%;'
        + 'height: ' + Math.ceil(height) + '%;'
        + 'top: ' + top + '%;'
        //+ 'bottom: ' + top + '%;'
        + 'left: ' + left + '%;'
        // + 'right: ' + left + '%;'
    );

};

frameImage.on('load', updatePhotoPosition);

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

    if (!resultImage) {
        resultImage = $('<img>').addClass('result');
        frameContainer.prepend(resultImage);
    }

    let canvas = $('<canvas>').attr('width', cropData.width).attr('height', cropData.height)[0],
        ctx = canvas.getContext("2d");

    ctx.drawImage(originImage[0], cropData.x, cropData.y, cropData.width, cropData.height, 0, 0, cropData.width, cropData.height);
    resultImage.attr('src', canvas.toDataURL());

    uploadContainer.hide();
    validation.hide();
    frameContainer.addClass('with-image').removeClass('no-image');
    updatePhotoPosition();
    crop_container.height('');
    crop_container.width('');
    cropper.destroy();
});

//</editor-fold>

//<editor-fold desc="File actions">
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
        setFrameURL(info.object.frame_img);

        init_change_action();
        setUpFormat();
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
    getElemByProp('format_id').change(changeArea);
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