<?php
$rules = [
    'GET /order' => 'order/index',
    'GET /hyperrealism' => 'order/order-hyperrealism',
    'GET /photorealism' => 'order/order-photorealism',
    'GET /sketch' => 'order/order-sketch',

    'POST /order/change/<field:\d+>/<value:\w+>' => 'order/change',

    'GET /cart' => 'cart/index',

    'POST /admin/admin/load-del-modal' => 'admin/admin/load-del-modal',
    'GET /admin' => 'admin/admin/admin',
    'POST /admin/frame-mount-image/change/<frame_id:\d+>' => 'admin/frame-mount-image/change',
];

$post_actions = array('validate', 'update', 'delete', 'edit');

foreach ($params['admin_models'] as &$model_name) {
    $model_base_url = 'admin/'. $model_name;

    $rules['GET /   ' . $model_base_url .'s'] = $model_base_url. '/index';

    foreach ($post_actions as &$action)
        $rules['POST ' . $model_base_url .'/'. $action. '/<id:\d+>'] = $model_base_url. '/'. $action;

}

return $rules;