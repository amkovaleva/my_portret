<?php

namespace app\controllers;

use app\models\CartItem;
use Yii;

class CartController extends BaseSiteController
{

    public function actionIndex()
    {
        $this->view->title = Yii::t('app/carts', 'title');

        return $this->render('index', ['items' => CartItem::getCartItemsForUser()]);
    }

}
