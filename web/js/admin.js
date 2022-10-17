"use strict";
let pressed_link = null;

let closeModal = function (modal_id = 'modal-del') {
    $(`#${modal_id} button.close`).trigger('click');
};

let openModal = function (modal_id = 'modal-del', need_set_id = true) {
    if(need_set_id)
        $(`#${modal_id} .modal-body span`).text(pressed_link.parents('tr').children().first().text());
    $(`#${modal_id}`).modal();
};

let sendPost = function (url, callback, need_clear_link = true) {
    $.post(url, callback).fail(function () {
        console.log("error");
    }).always(function () {
        if (need_clear_link)
            pressed_link = null;
    });
};

let initModal = function () {
    $('#modal-del .btn-primary').click(() => {
        if (pressed_link)
            sendPost(pressed_link.attr('href'), (del_result) => {
                if (del_result.success === 1) {
                    let hidden_inputs = $('#edit-form input[type=hidden]').toArray(),
                        del_id = pressed_link.parents('tr').attr('data-key'),
                        isDeletedEdit = hidden_inputs.some((el) => {
                            let id_parts = el.id.split('-');
                            if (id_parts[id_parts.length - 1] !== 'id')
                                return false;
                            return $(el).val() === del_id;
                        });
                    if (isDeletedEdit)
                        $.pjax.reload({container: '#pjax', async: false});
                    else
                        pressed_link.parents('tr').remove();
                }
            });
        closeModal();
    });
};

let initGridActions = function () {
    $('.delete-row').unbind('click').click((event) => {
        event.preventDefault();
        pressed_link = $(event.target);
        if (!$('#modal-del').length)
            sendPost($('#modal-del-container').attr('data-load-modal-url'), (html) => {
                $('#modal-del-container').html(html);
                initModal();
                openModal();
            }, false);
        else
            openModal();
        return false;
    });
    $('.edit-row').unbind('click').click((event) => {
        event.preventDefault();
        event.stopPropagation();
        pressed_link = $(event.target);

        sendPost(pressed_link.attr('href'), (html) => {
            $('#form-container').html(html);
            initFormActions();
            window.scrollTo(0, 0);
        });
        return false;
    });
};

let initFormActions = function () {
    let editForm = $('#edit-form, #contact-form, #portrait-form, #status-form'),
        file_input = editForm.find('input[type=file]'),
        id_input = editForm.find('input[type=hidden][id]'),
        id = id_input.val(),
        model_img = editForm.find('img');

    editForm.unbind('submit').submit((event) => {

        event.preventDefault();
        event.stopPropagation();

        let data = new FormData(event.target), url = event.target.action;

        $.ajax({
            url: url,
            type: 'post',
            data: data,
            cache: false,
            contentType: false,
            processData: false
        }).done(function (response) {
            if (response.success && $.pjax) {
                if(response.pjax_id === undefined)
                    $.pjax.reload({container: '#pjax', async: false});
                else if(response.pjax_id)
                    $.pjax.reload({container: '#'+response.pjax_id, async: false});

            }
            if(response.success && response.needModal){
                openModal('modal-saved', false);
            }
            if(response.info_container && response.info){
                $('#' + response.info_container).html(response.info);
            }
        }).fail(function () {
            console.log("error");
        });
    });

    editForm.find('button.btn-secondary').unbind('click').click(() => {
        editForm[0].reset();
        $.pjax.reload({container: '#pjax', async: false});
    });


    if(file_input.length && model_img.length)
        if(!model_img.attr('src'))
            model_img.hide();
        file_input.unbind('change').change(() => {
            const [file] = file_input[0].files
            if (file) {
                model_img[0].src = URL.createObjectURL(file)
                model_img.show();
            }
        });

    let need_callback_change = $('select[change_url]');
    let change_callback = (event) => {
        if(id !== id_input.val()){
            id = id_input.val();
            return;
        }
        let el = $(event.target);
        sendPost(el.attr('change_url') + ( parseInt( el.val()) || 0) + '/', (info) => {
            let updated_list = $('#'+ info.id)
            updated_list.html('');
            if(!info.without_prompt)
                updated_list.append($('<option>').text('--'));
            if (info.length === 0 || info.items.length === 0)
                return;
            info.items.forEach(option => {
                let op = $('<option>');
                op.attr('value', option.id);
                op.text(option.name);
                updated_list.append(op);
            })
            updated_list.trigger('change');
        });
    };
    need_callback_change.unbind('change', change_callback).bind('change', change_callback);
};

let initBaseActions = function () {
    initGridActions();
    initFormActions();
}

initBaseActions();

$(document).on('pjax:success', function () {
    initBaseActions();
});