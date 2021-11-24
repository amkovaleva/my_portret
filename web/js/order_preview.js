'use strict'

const dropZone = $('#drop-zone')[0];
const img_container =  $('#image-content');
const upload_container = $('#upload-content');
const file_input = $('#orderform-image')[0];

const reader = new FileReader();

let update_img = function (src){
    img_container.html('');
    const img = $('<img>').attr('src', src).attr('alt', img_container.attr('alt'));
    img_container.append(img);
    upload_container.hide();
};

if (window.FileList && window.File) {
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
else {
    dropZone.remove();
}


file_input.onchange = () => {
    const [file] = file_input.files
    if (file) {
        update_img(URL.createObjectURL(file));
    }
};
