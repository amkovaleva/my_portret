<?php

namespace app\controllers\admin;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;

class AdminController extends Controller
{

    public function beforeAction($action)
    {
        if(! parent::beforeAction($action))
            return false;

        if (Yii::$app->user->isGuest)
            $this->redirect(Url::to('user/login'));

        return true;
    }

    public function actionLoadDelModal()
    {
        Yii::$app->response->format = Response::FORMAT_HTML;
        return $this->renderAjax('delete_modal');
    }

    public function actionAdmin()
    {
        $this->view->title = $this->getTitle();
        $this->layout = 'admin';

        return $this->render('index');
    }

    public function actionIndex()
    {
        $this->view->title = $this->getTitle();
        $this->layout = 'admin';

        $searchModel = $this->searchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'model' => $this->getModelById(),
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionValidate($id = 0)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->getModelById($id);

        if ($this->isModelLoaded($model)) {
            return ActiveForm::validate($model);
        }
        return [];
    }

    public function actionUpdate($id = 0)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->getModelById($id);

        if ($this->isModelLoaded($model)) {
            return ['success' => $model->save()];
        }
        return [];
    }


    public function actionDelete($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->getModelById($id);
        return ['success' => $model->delete()];
    }

    public function actionEdit($id)
    {
        $model = $this->getModelById($id);
        Yii::$app->response->format = Response::FORMAT_HTML;
        return $this->renderAjax('edit', ['model' => $model]);
    }

    public function getModelById($id = 0)
    {
        return null;
    }

    public function searchModel(){
        return null;
    }

    public function getTitle(){
        return Yii::t('admin/base', 'admin_title');
    }

    public function isModelLoaded($model)
    {
        $request = Yii::$app->getRequest();
        return $request->isPost && $model->load($request->post());
    }

}
