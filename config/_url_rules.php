<?php
$rules = [
    'POST admin/admin/load-del-modal' => 'admin/admin/load-del-modal',
    'GET admin' => 'admin/admin/admin',
];

$models = array('colour', 'format', 'mount', 'frame', 'background-colour', 'background-material', 'paint-material', 'portrait-type', 'price');
$post_actions = array('validate', 'update', 'delete', 'edit');

foreach ($models as &$model_name) {
    $model_base_url = 'admin/'. $model_name;

    $rules['GET ' . $model_base_url .'s'] = $model_base_url. '/index';

    foreach ($post_actions as &$action)
        $rules['POST ' . $model_base_url .'/'. $action. '/<id:\d+>'] = $model_base_url. '/'. $action;

}

return $rules;