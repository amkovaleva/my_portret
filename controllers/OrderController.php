<?php

namespace app\controllers;

use app\models\base\PortraitType;
use app\models\base\Price;
use Yii;
use app\models\CartItem;
use yii\web\Response;

class OrderController extends BaseSiteController
{

    public function actionIndex()
    {
        $this->view->title = Yii::t('app/orders', 'title');
        return $this->render('index',
            [
                'prices' => Price::getPricesInfo(),
                'currencies' => [Price::CURRENCIES, Price::CURRENCY_SYMBOL],
                'active_currency' => Price::getDefaultCurrency(),
            ]
        );
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

        $save_result = null;
        if( Yii::$app->request->isPost){
            $model = new CartItem();

            if ($this->isModelLoaded($model)) {
                $save_result = $model->saveWithImage(true, false, json_decode($model->crop_data));
            }
        }

        return $this->render('order', [
            'model' => $this->getDefaultModel($type),
            'save_result' => $save_result,
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
