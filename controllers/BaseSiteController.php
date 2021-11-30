<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\LoginForm;

class BaseSiteController extends Controller
{

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action))
            return false;

        Yii::$app->assetManager->bundles['yii\bootstrap4\BootstrapAsset'] = false;

        $name = Yii::$app->params['cookie_name'];
        $cookie = isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
        $days = Yii::$app->params['days_for_cart'];
        if (!$cookie) {
            $cookie = md5(uniqid());
            setcookie($name, $cookie, time() + 86400 * $days, '/');
        }


        Yii::$app->params['cookie_value'] = $cookie;

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
}
