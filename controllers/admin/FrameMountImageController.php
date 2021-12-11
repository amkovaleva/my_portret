<?php

namespace app\controllers\admin;

use app\models\base\Frame;
use app\models\base\FrameMountImage;
use app\models\base\search\SearchFrameMountImage;
use Yii;
use yii\web\Response;

class FrameMountImageController extends AdminController
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

    public function actionChange($frame_id = 0)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $res = FrameMountImage::getPossiblePortraitFormats($frame_id);
        return ['id' => 'framemountimage-portrait_format_id', 'items' =>  $res];
    }

    public function getModelById($id = 0)
    {
        $model = FrameMountImage::findOne(['id' => $id]);

        if(!$model) {
            $model = new FrameMountImage();
            $model->frame_id = Frame::find()->one()->id;
        }

        return $model;
    }


    public function searchModel(){
        return new SearchFrameMountImage();
    }

    public function getTitle(){
        return Yii::t('admin/frame-mount-images', 'title');
    }
}
