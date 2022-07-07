<?php

namespace app\controllers;

use app\models\Order;
use Yii;

class CartController extends BaseSiteController
{
    public function actionIndex()
    {

        $this->view->title = Yii::t('app/carts', 'title');
        $model = new Order();
        $model->fillDefault();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('order_made',  true);

            return $this->refresh();
        }

        return $this->render('index', [
            'model' => $model,
            'item' => $model->cartItem
        ]);
    }
}
