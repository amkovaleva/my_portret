<?php
$rules = [
    'GET /' => 'site/index',
    'GET /store' => 'order/index',
    '/contact' => 'site/contact',
    'GET /gallery' => 'site/gallery',

    'POST /order/change/<field:\w+>/<value:\w+>' => 'order/change',

    'GET /cart' => 'cart/index',
    'POST /cart/delete/<id:\d+>' => 'cart/delete',
    'POST /load-del-modal' => 'cart/load-del-modal',

    'POST /admin/admin/load-del-modal' => 'admin/admin/load-del-modal',
    'GET /admin' => 'admin/admin/admin',
    'POST /admin/mount/change/<frame_id:\d+>' => 'admin/mount/change',
    'POST /admin/mount/validate' => 'admin/mount/validate',
];

foreach ($params['portrait_types'] as $key => &$item) {
    $rules['/' . $key ] = 'order/order-'.$key;
}


$post_actions = array('validate', 'update', 'delete', 'edit');

foreach ($params['admin_models'] as &$cat) {

    foreach ($cat as &$model_name) {
        $model_base_url = 'admin/' . $model_name;

        $rules['GET /' . $model_base_url . 's'] = $model_base_url . '/index';

        foreach ($post_actions as &$action)
            $rules['POST ' . $model_base_url . '/' . $action . '/<id:\d+>'] = $model_base_url . '/' . $action;
    }
}

return $rules;