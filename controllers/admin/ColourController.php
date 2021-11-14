<?php

namespace app\controllers\admin;

use app\models\base\Colour;
use app\models\base\search\SearchColour;
use Yii;

class ColourController extends AdminController
{

    public function getModelById($id = 0)
    {
        $model = Colour::findOne(['id' => $id]);

        if(!$model)
            $model = new Colour();

        return $model;
    }


    public function searchModel(){
        return new SearchColour();
    }

    public function getTitle(){
        return Yii::t('admin/colours', 'title');
    }
}
