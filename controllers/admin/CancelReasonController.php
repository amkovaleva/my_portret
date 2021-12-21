<?php

namespace app\controllers\admin;

use app\models\base\CancelReason;
use app\models\base\search\SearchCancelReason;
use Yii;

class CancelReasonController extends AdminController
{

    public function getModelById($id = 0)
    {
        $model = CancelReason::findOne(['id' => $id]);

        if(!$model)
            $model = new CancelReason();

        return $model;
    }


    public function searchModel(){
        return new SearchCancelReason();
    }

    public function getTitle(){
        return Yii::t('admin/cancel-reasons', 'title');
    }
}
