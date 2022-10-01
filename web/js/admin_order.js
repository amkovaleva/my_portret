"use strict";

let need_update_info_on_change = $('[data-change-url]');
let update_info_callback = (event) => {
    let el = $(event.target), form = el.parents('form')[0];
    let data = new FormData(form), url = form.action;

    $.ajax({
        url: el.attr('data-change-url'),
        type: 'post',
        data: data,
        cache: false,
        contentType: false,
        processData: false
    }).done(function (response) {
        if(response.info_container && response.info){
            $('#' + response.info_container).html(response.info);
        }
    }).fail(function () {
        console.log("error");
    });
};
need_update_info_on_change.bind('change', update_info_callback);
