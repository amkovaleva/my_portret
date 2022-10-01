<?php

namespace app\controllers\admin;

use app\models\base\CountFace;
use app\models\base\Price;
use app\models\CartItem;
use Yii;
use yii\web\Response;

class CartItemController extends AdminController
{

    public function actionUpdate($id = 0)
    {
        return $this->getInfoContent($id, true);
    }

    public function actionChange($id = 0)
    {
        return $this->getInfoContent($id, false);
    }

    private function getInfoContent($id, $need_save)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->getModelById($id);

        if ($this->isModelLoaded($model)) {
            $info = [
                'info_container' => 'info_container',
                'info' => $this->renderPartial('//admin/order/info_view',
                    [
                        'price' => Price::getPriceForCartItem($model),
                        'faces_coeff' => CountFace::getCoefficient($model->faces_count)
                    ])
            ];
            if ($need_save) {
                $info['success'] = $model->save();
                $info['needModal'] = true;
            }
            return $info;
        }
        return [];
    }

    public function getModelById($id = 0)
    {
        $model = CartItem::findOne(['id' => $id]);

        if (!$model)
            $model = new CartItem();

        return $model;
    }

}
