<?php

namespace app\controllers\admin;

use app\models\Order;
use app\models\SearchOrder;
use Yii;
use yii\web\NotFoundHttpException;

class OrderController extends AdminController
{


    public function actionEdit($id)
    {
        $this->layout = 'admin';

        $model = $this->getModelWithRels($id);

        return $this->render('edit', [
            'model' => $model,
        ]);
    }

    public function getModelById($id = 0)
    {
        $model = Order::findOne(['id' => $id]);

        if (!$model)
            return new Order();

        return $model;
    }

    /**
     * @throws NotFoundHttpException
     */
    public function getModelWithRels($id = 0)
    {
        $model = Order::findOne(['id' => $id]);

        if (!$model)
            throw new \yii\web\NotFoundHttpException;

        $model = Order::find()->innerJoinWith(['cartItem', 'cartItem.portraitType', 'cartItem.format',
            'cartItem.backgroundMaterial', 'cartItem.paintMaterial', 'cartItem.backgroundColour.colour'])
            ->joinWith(['cartItem.addons', 'cartItem.frame', 'cartItem.frame.format', 'cartItem.mount',])
            ->where([Order::tableName() . '.id' => $id])->one();

        return $model;
    }

    public function searchModel()
    {
        return new SearchOrder();
    }

    public function getTitle()
    {
        return Yii::t('admin/orders', 'title');
    }
}
