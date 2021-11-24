<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\OrderForm;
use yii\web\Response;
use yii\widgets\ActiveForm;

class OrderController extends Controller
{

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action))
            return false;

        Yii::$app->assetManager->bundles['yii\bootstrap4\BootstrapAsset']  = false;
        return true;
    }

    public function actionIndex()
    {
        $this->view->title = Yii::t('app/orders', 'title');
        $this->layout = 'order';

        return $this->render('index', [
            'model' =>$this->defaultModel
        ]);
    }

    public function actionValidate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model =  $this->defaultModel;

        if ($this->isModelLoaded($model)) {
            return ActiveForm::validate($model);
        }
        return [];
    }

    public function actionCreate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->defaultModel;

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

    public function getDefaultModel(){
        $model = new OrderForm();
        $model->fillDefaultModel();
        return $model;
    }
}
