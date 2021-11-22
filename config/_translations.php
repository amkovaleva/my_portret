<?php
$fileMap = [
    'app/base' => 'base.php',
];

$models = array('colour', 'format', 'mount', 'frame', 'background-colour', 'background-material', 'paint-material', 'portrait-type', 'price', 'frame-mount-image');

foreach ($models as &$model_name)
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