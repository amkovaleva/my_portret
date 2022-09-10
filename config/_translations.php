<?php
$fileMap = [
    'app/base' => 'base.php',
    'app/order' => 'order.php',
];


foreach ($params['admin_models'] as &$cat)
    foreach ($cat as &$model_name)
        $fileMap['app/'.$model_name] = $model_name . '.php';

return [
    'category' => [
        'forceTranslation' => true,
    ],
    'admin*' => [
        'class' => 'yii\i18n\PhpMessageSource',
        //'basePath' => '@app/messages',
        //'sourceLanguage' => 'en-US',
        'fileMap' => $fileMap,
    ],
    'app*' => [
        'class' => 'yii\i18n\PhpMessageSource',
        //'basePath' => '@app/messages',
        //'sourceLanguage' => 'en-US',
        'fileMap' => [
            'app/order' => 'order.php',
        ],
    ],
];