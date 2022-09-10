<?php

namespace app\controllers\admin;

use app\models\Order;
use app\models\SearchOrder;
use Yii;

class OrderController extends AdminController
{

    public function getModelById($id = 0)
    {
        $model = Order::findOne(['id' => $id]);

        if(!$model)
            $model = new Order();

        return $model;
    }



    public function searchModel(){
        return new SearchOrder();
    }

    public function getTitle(){
        return Yii::t('admin/orders', 'title');
    }
}
