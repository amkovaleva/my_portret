<?php

namespace app\controllers\admin;

use app\models\base\Frame;
use app\models\base\search\SearchFrame;
use Yii;
use yii\web\Response;

class FrameController extends AdminController
{

    public function actionUpdate($id = 0)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->getModelById($id);

        if (parent::isModelLoaded($model)) {
            $res = $this->saveWithImage($model);
            return ['success' => $res];
        }
        return [];
    }


    public function getModelById($id = 0)
    {
        $model = Frame::findOne(['id' => $id]);

        if(!$model)
            $model = new Frame();

        return $model;
    }


    public function searchModel(){
        return new SearchFrame();
    }

    public function getTitle(){
        return Yii::t('admin/frames', 'title');
    }
}
