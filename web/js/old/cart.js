'use strict'
const modal_id = 'modal-del';
let pressed_link = null;
const modal_container = $('#modal-del-container');
const load_modal_url = modal_container.attr('data-load-modal-url');
const del_action_url = modal_container.attr('data-del-url');

let sendPost = function (url, callback) {
    $.post(url, callback).fail(function () {
        console.log("error");
    })
};

let initModal = function () {
    $('#modal-del .btn-primary').click(() => {
        let item_container = pressed_link.parents('.cart-item');
        sendPost(del_action_url+ item_container.attr('data-key')  + '/', (del_result) => {
            if (del_result.success === 1) {
                item_container.remove();
                let cart_nav = $('#cart a');
                if(cart_nav.length){
                    let text_parts = cart_nav.text().split(' ');
                    text_parts[2] = del_result.count;
                    cart_nav.text( text_parts.join(' '));
                }
            }
        });
        $(`#${modal_id} button.close`).trigger('click');
    });
};

$('.cart-item input').unbind('click').click((event) => {
    event.preventDefault();
    pressed_link = $(event.target);
    if (!$(`#${modal_id}`).length)
        sendPost(load_modal_url , (html) => {
            modal_container.html(html);
            initModal();
            $(`#${modal_id}`).modal();
        }, false);
    else
        $(`#${modal_id}`).modal();
    return false;
});