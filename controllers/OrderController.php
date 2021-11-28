<?php

namespace app\controllers;

use app\models\base\PortraitType;
use Yii;
use yii\web\Controller;
use app\models\OrderForm;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

class OrderController extends Controller
{

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action))
            return false;

        Yii::$app->assetManager->bundles['yii\bootstrap4\BootstrapAsset'] = false;
        return true;
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

    private function order($type){

        $this->view->title = Yii::t('app/orders', 'title');
        $this->layout = 'order';

        return $this->render('order', [
            'model' => $this->getDefaultModel($type)
        ]);
    }

    public function actionIndex()
    {
        $this->view->title = Yii::t('app/orders', 'title');
        $this->layout = 'order';
        $portrait_types = PortraitType::find()->all();
        return $this->render('index', ['portrait_types' => $portrait_types]);
    }

    // <editor-fold state="collapsed" desc="change values on form">


    public function actionChange($field, $value)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = new OrderForm();

        if (!$this->isModelLoaded($model))
            return ['success' => false];

        return $model->fillDownFrom($field, $value);
    }


    // </editor-fold>

    public function actionValidate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new OrderForm();

        if ($this->isModelLoaded($model)) {
            return ActiveForm::validate($model);
        }
        return [];
    }

    public function actionCreate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new OrderForm();

        if ($this->isModelLoaded($model)) {
            return ['success' => $model->save()];
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
        $model = new OrderForm();
        $model->fillDefaultModel($type);
        return $model;
    }
}
