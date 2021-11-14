<?php

namespace app\controllers\admin;

use app\models\base\BackgroundMaterial;
use app\models\base\search\SearchBackgroundMaterial;
use Yii;

class BackgroundMaterialController extends AdminController
{

    public function getModelById($id = 0)
    {
        $model = BackgroundMaterial::findOne(['id' => $id]);

        if(!$model)
            $model = new BackgroundMaterial();

        return $model;
    }


    public function searchModel(){
        return new SearchBackgroundMaterial();
    }

    public function getTitle(){
        return Yii::t('admin/background-materials', 'title');
    }
}
