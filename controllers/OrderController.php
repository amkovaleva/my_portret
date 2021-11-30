<?php

namespace app\controllers;

use app\models\base\PortraitType;
use Yii;
use app\models\CartItem;
use yii\web\Response;

class OrderController extends BaseSiteController
{

    public function actionIndex()
    {
        $this->view->title = Yii::t('app/orders', 'title');
        $this->layout = 'order';
        $portrait_types = PortraitType::find()->all();
        return $this->render('index', ['portrait_types' => $portrait_types]);
    }

    public function actionOrderHyperrealism()
    {

        return $this->order(1);
    }

    public function actionOrderPhotorealism()
    {
        return $this->order(2);
    }

    public function actionOrderSketch()
    {
        return $this->order(3);
    }

    private function order($type)
    {
        $this->view->title = Yii::t('app/orders', 'title');
        $this->layout = 'order';

        return $this->render('order', [
            'model' => $this->getDefaultModel($type)
        ]);
    }

    public function actionChange($field, $value)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = new CartItem();

        if (!$this->isModelLoaded($model))
            return ['success' => false];

        return $model->fillDownFrom($field, $value);
    }


    public function actionCreate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new CartItem();

        if ($this->isModelLoaded($model)) {

            $res = $model->saveWithImage(true, false);
            return ['success' => $res];
        }
        return [];
    }

    public function isModelLoaded($model)
    {
        $request = Yii::$app->getRequest();
        return $request->isPost && $model->load($request->post());
    }

    public function getDefaultModel($type)
    {
        $model = new CartItem();
        $model->fillDefaultModel($type);
        return $model;
    }
}
