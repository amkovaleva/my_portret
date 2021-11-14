<?php

namespace app\controllers\admin;

use app\models\base\Price;
use app\models\base\search\SearchPrice;
use Yii;

class PriceController extends AdminController
{

    public function getModelById($id = 0)
    {
        $model = Price::findOne(['id' => $id]);

        if(!$model)
            $model = new Price();

        return $model;
    }


    public function searchModel(){
        return new SearchPrice();
    }

    public function getTitle(){
        return Yii::t('admin/prices', 'title');
    }
}
