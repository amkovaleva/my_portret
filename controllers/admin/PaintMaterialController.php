<?php

namespace app\controllers\admin;

use app\models\base\PaintMaterial;
use app\models\base\search\SearchPaintMaterial;
use Yii;

class PaintMaterialController extends AdminController
{

    public function getModelById($id = 0)
    {
        $model = PaintMaterial::findOne(['id' => $id]);

        if(!$model)
            $model = new PaintMaterial();

        return $model;
    }


    public function searchModel(){
        return new SearchPaintMaterial();
    }

    public function getTitle(){
        return Yii::t('admin/paint-materials', 'title');
    }
}
