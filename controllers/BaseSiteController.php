<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class BaseSiteController extends Controller
{

    public function beforeAction($action)
    {

        $res = parent::beforeAction($action);

        if(Yii::$app->request->isGet){
            $url =  Yii::$app->request->url;

            if(!strlen($url) || substr($url, -1) != '/') {
                Yii::$app->response->redirect($url . '/', 301);
                Yii::$app->end();
                return $res;
            }
        }


        Yii::$app->assetManager->bundles['yii\bootstrap4\BootstrapAsset'] = false;

        $name = Yii::$app->params['cookie_name'];
        $cookie = isset($_COOKIE[$name]) ? $_COOKIE[$name] : null;
        $days = Yii::$app->params['days_for_cart'];
        if (!$cookie) {
            $cookie = md5(uniqid());
            setcookie($name, $cookie, time() + 86400 * $days, '/');
        }


        Yii::$app->params['cookie_value'] = $cookie;

        return $res;
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
