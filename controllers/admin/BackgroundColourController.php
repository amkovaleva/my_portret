<?php

namespace app\controllers\admin;

use app\models\base\BackgroundColour;
use app\models\base\search\SearchBackgroundColour;
use Yii;

class BackgroundColourController extends AdminController
{

    public function getModelById($id = 0)
    {
        $model = BackgroundColour::findOne(['id' => $id]);

        if(!$model)
            $model = new BackgroundColour();

        return $model;
    }


    public function searchModel(){
        return new SearchBackgroundColour();
    }

    public function getTitle(){
        return Yii::t('admin/background-colours', 'title');
    }
}
