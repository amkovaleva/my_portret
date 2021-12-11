<?php

namespace app\controllers\admin;

use app\models\base\Frame;
use app\models\base\Mount;
use app\models\base\search\SearchMount;
use Yii;
use yii\web\Response;

class MountController extends AdminController
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
        $res = Mount::getPossiblePortraitFormats($frame_id);
        return ['id' => 'mount-portrait_format_id', 'items' =>  $res];
    }

    public function getModelById($id = 0)
    {
        $model = Mount::findOne(['id' => $id]);

        if(!$model) {
            $model = new Mount();
            $model->frame_id = Frame::find()->one()->id;
        }

        return $model;
    }


    public function searchModel(){
        return new SearchMount();
    }

    public function getTitle(){
        return Yii::t('admin/mounts', 'title');
    }
}
