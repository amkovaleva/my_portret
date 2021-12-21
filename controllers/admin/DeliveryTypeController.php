<?php

namespace app\controllers\admin;

use app\models\base\DeliveryType;
use app\models\base\search\SearchDeliveryType;
use Yii;

class DeliveryTypeController extends AdminController
{

    public function getModelById($id = 0)
    {
        $model = DeliveryType::findOne(['id' => $id]);

        if(!$model)
            $model = new DeliveryType();

        return $model;
    }


    public function searchModel(){
        return new SearchDeliveryType();
    }

    public function getTitle(){
        return Yii::t('admin/delivery-types', 'title');
    }
}
