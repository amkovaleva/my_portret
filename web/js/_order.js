'use strict'

let form;
let fileInput;
let modal;
let crop_container;
let default_img;
let originImage;
let resultImage = null;
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


let changeArea = function () {
    if (fileInput.val()) {
        show_crop_wnd();
    }
};

let loadPhoto = function (src) {
    originImage.unbind('load').on('load', changeArea)
    originImage.attr('src', src);
};

let setUpFormat = function () {
    let format = window.formatSizes[getFormatID()],
        newSizes = [1 * format.length, 1 * format.width],
        is_old_format = sideSizes.length && sideSizes[0] === newSizes[0] && sideSizes[1] === newSizes[1];

    sideSizes = newSizes;
    if (!is_old_format)
        changeArea();
};

let show_crop_wnd = function (){

    modal.show();
    crop_container.height(originImage.height());
    crop_container.width(originImage.width());
    let ratio = isPortraitOrientation ? sideSizes[1] / sideSizes[0] : sideSizes[0] / sideSizes[1];
    originImage.cropper({aspectRatio: ratio});
    cropper = originImage.data('cropper');
    cropper.setAspectRatio(ratio);
    cropper.init();

};

let hide_crop_wnd = function (){
    cropData = cropper.getData();

    if (!resultImage) {
        resultImage = $('<img alt="' + frameContainer.attr('data-alt') + '">').addClass('result');
        frameContainer.prepend(resultImage);
    }

    let canvas = $('<canvas>').attr('width', cropData.width).attr('height', cropData.height)[0],
        ctx = canvas.getContext("2d");

    ctx.drawImage(originImage[0], cropData.x, cropData.y, cropData.width, cropData.height, 0, 0, cropData.width, cropData.height);
    resultImage.attr('src', canvas.toDataURL());

    updatePhotoPosition();
    crop_container.height('');
    crop_container.width('');
    cropper.destroy();
};

(function($) {

    form = $('#order-form');
    fileInput = $('#cartitem-image');
    default_img = $('.stage__portrait').attr('src');
    modal = $('#crop-modal');
    crop_container = modal.find('.modal__content');
    originImage = modal.find('img');


    form.unbind('submit').bind('submit', (event) => {
        if (!fileInput[0].files.length) {
            event.preventDefault();
            event.stopPropagation();
            $('.shim').show()
            return false;
        }
        getElemByProp('crop_data').val(JSON.stringify(cropData));
    });
    init_change_action();

    $('.order__uploading-hint .upload').on('click', () => {
        fileInput.trigger('click');
    })

    $('#change-area').click(changeArea);

    if (fileInput.length)
        fileInput.on('change', () => {
            const [file] = fileInput[0].files
            if (file) {
                let is_valid_ext = ['jpeg', 'jpg', 'bmp', 'png'].includes(file.name.split('.').pop().toLowerCase());
                if(is_valid_ext){
                    loadPhoto(URL.createObjectURL(file));
                }
                else {
                    fileInput.val('');
                    $('.stage__portrait').attr('src', default_img);
                }
            }
        });

})(jQuery);