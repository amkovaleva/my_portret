'use strict'

let form;
let fileInput;
let modal;
let crop_image_container;
let crop_container;
let default_img;
let uploaded_img;
let originImage;
let cropData, cropper, sideSizes = [];
let isPortraitOrientation = true;

let sendPost = function (url, callback) {
    $.post(url, form.serializeArray(), callback).fail(function () {
        console.log("error");
    });
};

let getElemByProp = function (field) {
    return $('#cartitem-' + field);
};

let getFormatID = function () {
    return getElemByProp('format_id').val();
};

let change_callback = (event) => {

    let el = $(event.target);
    let field_type = el.attr('name').replace('CartItem[', '').replace(']', '');

    if(field_type === 'material_id')
        $('.materials__output').text($('.materials__tools-choice .materials__widget:checked ~ span').text());

    if(field_type === 'format_id')
        setUpFormat()

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


let changeArea = function () {
    if (isImgUploaded())
        show_crop_wnd();
    else
        setDefaultPhoto();
};

let isImgUploaded = function (){
    return !!fileInput.val()
};

let loadPhoto = function (src) {
    originImage.unbind('load').on('load', changeArea)
    originImage.attr('src', src);
};

let clearPhoto = function () {
    fileInput.val('');
    setDefaultPhoto();
};

let setDefaultPhoto = function () {
    uploaded_img.attr('src', isPortraitOrientation ? default_img : default_img.replace('.', '-r.'));
};

let changeOrientation = function () {
    isPortraitOrientation = !isPortraitOrientation;
    changeArea();
};

let setUpFormat = function () {
    let format = window.formatSizes[getFormatID()],
        newSizes = [+format.length, +format.width],
        is_old_format = sideSizes.length && sideSizes[0] === newSizes[0] && sideSizes[1] === newSizes[1];

    sideSizes = newSizes;
    if (!is_old_format)
        changeArea();
};

let show_crop_wnd = function (){

    modal.show();
    let height = originImage.height(),
        width = originImage.width(),
        image_ratio = Math.min(crop_container.height() / height, crop_container.width() / width);

    crop_image_container.height(image_ratio * height);
    crop_image_container.width(image_ratio * width);

    let ratio = isPortraitOrientation ? sideSizes[1] / sideSizes[0] : sideSizes[0] / sideSizes[1];
    originImage.cropper({aspectRatio: ratio});
    cropper = originImage.data('cropper');
    cropper.setAspectRatio(ratio);
    cropper.init();

};

let hide_crop_wnd = function (){
    cropData = cropper.getData();

    let canvas = $('<canvas>').attr('width', cropData.width).attr('height', cropData.height)[0],
        ctx = canvas.getContext("2d");

    ctx.drawImage(originImage[0], cropData.x, cropData.y, cropData.width, cropData.height, 0, 0, cropData.width, cropData.height);
    uploaded_img.attr('src', canvas.toDataURL());

    crop_image_container.height('');
    crop_image_container.width('');
    cropper.destroy();
    modal.hide();
};

let init_portrait_data = function (){

    form = $('#order-form');
    fileInput = $('#cartitem-image');
    uploaded_img = $('.stage__portrait');
    default_img = uploaded_img.attr('src');
    modal = $('#crop-modal');
    crop_container = $('.modal__content');
    crop_image_container = modal.find('.cropper_content');
    originImage = modal.find('img');

    modal.find('.button.btn-secondary').click(hide_crop_wnd);
    uploaded_img.click(()=> fileInput.trigger(isImgUploaded() ? 'change' : 'click'));

    $('.order__option.action--move').click(changeArea);
    $('.order__option.action--clear').click(clearPhoto);
    $('.order__option.action--rotate').click(changeOrientation);

};

let init_file_actions = function (){

    $('.order__uploading-hint .upload').on('click', () => {
        fileInput.trigger('click');
    })

    if (fileInput.length)
        fileInput.on('change', () => {
            const [file] = fileInput[0].files
            if (file) {
                let is_valid_ext = ['jpeg', 'jpg', 'bmp', 'png'].includes(file.name.split('.').pop().toLowerCase());
                if(is_valid_ext)
                    loadPhoto(URL.createObjectURL(file));
                else
                    clearPhoto();

            }
        });

};

(function($) {

    init_portrait_data();

    form.unbind('submit').bind('submit', (event) => {
        if (!fileInput[0].files.length) {
            event.preventDefault();
            event.stopPropagation();
            $('#image_validation').show()
            return false;
        }
        getElemByProp('crop_data').val(JSON.stringify(cropData));
    });

    init_change_action();
    init_file_actions();

})(jQuery);