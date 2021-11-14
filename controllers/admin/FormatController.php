<?php

namespace app\controllers\admin;

use app\models\base\Format;
use app\models\base\search\SearchFormat;
use Yii;

class FormatController extends AdminController
{

    public function getModelById($id = 0)
    {
        $model = Format::findOne(['id' => $id]);

        if(!$model)
            $model = new Format();

        return $model;
    }


    public function searchModel(){
        return new SearchFormat();
    }

    public function getTitle(){
        return Yii::t('admin/formats', 'title');
    }
}
