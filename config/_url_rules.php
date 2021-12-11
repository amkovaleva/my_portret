<?php
$rules = [
    'GET /' => 'site/index',
    'GET /order' => 'order/index',

    '/hyperrealism' => 'order/order-hyperrealism',
    '/photorealism' => 'order/order-photorealism',
    '/sketch' => 'order/order-sketch',

    'POST /order/change/<field:\d+>/<value:\w+>' => 'order/change',

    'GET /cart' => 'cart/index',
    'POST /cart/delete/<id:\d+>' => 'cart/delete',
    'POST /load-del-modal' => 'cart/load-del-modal',

    'POST /admin/admin/load-del-modal' => 'admin/admin/load-del-modal',
    'GET /admin' => 'admin/admin/admin',
    'POST /admin/mount/change/<frame_id:\d+>' => 'admin/mount/change',
    'POST /admin/mount/validate' => 'admin/mount/validate',
];

$post_actions = array('validate', 'update', 'delete', 'edit');

foreach ($params['admin_models'] as &$model_name) {
    $model_base_url = 'admin/'. $model_name;

    $rules['GET /' . $model_base_url .'s'] = $model_base_url. '/index';

    foreach ($post_actions as &$action)
        $rules['POST ' . $model_base_url .'/'. $action. '/<id:\d+>'] = $model_base_url. '/'. $action;

}

return $rules;