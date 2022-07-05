<?php

namespace app\controllers\admin;

use app\models\base\Addon;
use app\models\base\search\SearchAddon;
use Yii;

class AddonController extends AdminController
{

    public function getModelById($id = 0)
    {
        $model = Addon::findOne(['id' => $id]);

        if(!$model)
            $model = new Addon();

        return $model;
    }

    public function searchModel(){
        return new SearchAddon();
    }

    public function getTitle(){
        return Yii::t('admin/addons', 'title');
    }
}
