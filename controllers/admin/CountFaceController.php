<?php

namespace app\controllers\admin;

use app\models\base\CountFace;
use app\models\base\search\SearchCountFace;
use Yii;

class CountFaceController extends AdminController
{

    public function getModelById($id = 0)
    {
        $model = CountFace::findOne(['id' => $id]);

        if(!$model)
            $model = new CountFace();

        return $model;
    }


    public function searchModel(){
        return new SearchCountFace();
    }

    public function getTitle(){
        return Yii::t('admin/count-faces', 'title');
    }
}
