<?php

namespace app\controllers;

use app\models\CartItem;
use Yii;
use yii\web\Response;

class CartController extends BaseSiteController
{

    public function actionIndex()
    {
        $this->view->title = Yii::t('app/carts', 'title');

        return $this->render('index', ['items' => CartItem::getCartItemsForUser()]);
    }

    public function actionLoadDelModal()
    {
        Yii::$app->response->format = Response::FORMAT_HTML;
        return $this->renderAjax('delete_modal');
    }

    public function actionDelete($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = CartItem::find()->where(['id' => $id])->one();
        if(!$model)
            return [];

        $success = $model->delete();
        $count = CartItem::getCartItemsForMenu();

        return ['success' => $success,  'count' => $count ? $count['count'] : 0];
    }

}
