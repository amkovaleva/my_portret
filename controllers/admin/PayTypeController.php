<?php

namespace app\controllers\admin;

use app\models\base\PayType;
use app\models\base\search\SearchPayType;
use Yii;

class PayTypeController extends AdminController
{

    public function getModelById($id = 0)
    {
        $model = PayType::findOne(['id' => $id]);

        if(!$model)
            $model = new PayType();

        return $model;
    }


    public function searchModel(){
        return new SearchPayType();
    }

    public function getTitle(){
        return Yii::t('admin/pay-types', 'title');
    }
}
