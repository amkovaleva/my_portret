<?php

namespace app\controllers\admin;

use app\models\base\PaintMaterial;
use app\models\base\PortraitType;
use app\models\base\search\SearchPaintMaterial;
use app\models\base\search\SearchPortraitType;
use Yii;

class PortraitTypeController extends AdminController
{

    public function getModelById($id = 0)
    {
        $model = PortraitType::findOne(['id' => $id]);

        if(!$model)
            $model = new PortraitType();

        return $model;
    }


    public function searchModel(){
        return new SearchPortraitType();
    }

    public function getTitle(){
        return Yii::t('admin/portrait-types', 'title');
    }
}
