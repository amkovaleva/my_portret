<?php

namespace app\controllers\admin;

use app\models\base\Mount;
use app\models\base\search\SearchMount;
use Yii;

class MountController extends AdminController
{

    public function getModelById($id = 0)
    {
        $model = Mount::findOne(['id' => $id]);

        if(!$model)
            $model = new Mount();

        return $model;
    }


    public function searchModel(){
        return new SearchMount();
    }

    public function getTitle(){
        return Yii::t('admin/mounts', 'title');
    }
}
