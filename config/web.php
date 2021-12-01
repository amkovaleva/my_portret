<?php
$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$url_rules = require __DIR__ . '/_url_rules.php';
$translations = require __DIR__ . '/_translations.php';

$config = [
    'id' => 'basic',
    'language' => 'ru-RU',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@web_dir' => '@app/web',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'gtisAuXMov41iTcc28O0wNUWVLp9NVmL',
            'enableCsrfCookie' => false,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing'=>true,
            'rules' => $url_rules,
            'suffix' => '/',
        ],
        'i18n' => [
            'translations' => $translations,
        ],

    ],
    'modules' => [
        'user' => [
            'class' => Da\User\Module::class,
            'administratorPermissionName' => 'admin',
            'enableRegistration' => false,
            'enableEmailConfirmation' => false,
            'allowPasswordRecovery' => false,
            'controllerMap' => [
                'security' => [
                    'class' => \Da\User\Controller\SecurityController::class,
                    'on ' . \Da\User\Event\FormEvent::EVENT_AFTER_LOGIN => function (\Da\User\Event\FormEvent $event) {
                        \Yii::$app->controller->redirect(['/admin']);
                        \Yii::$app->end();
                    }
                ],
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
