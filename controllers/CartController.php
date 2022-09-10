<?php

namespace app\controllers;

use app\models\Order;
use Yii;
use yii\helpers\Url;

class CartController extends BaseSiteController
{
    public function actionIndex()
    {

        $this->view->title = Yii::t('app/carts', 'title');
        $model = new Order();
        $model->fillDefault();

        if(!$model->cart_item_id){
            $this->redirect(Url::to(['/order/index']));
            return;
        }

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
