<?php

namespace app\controllers\admin;

use app\models\base\Frame;
use app\models\base\Mount;
use app\models\Order;
use app\models\SearchOrder;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Response;

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

    public function actionUpdate($id = 0)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->getModelById($id);

        if ($this->isModelLoaded($model)) {
            return ['success' => $model->save(), 'needModal' => true, 'pjax_id' => ''];
        }
        return [];
    }

    public function actionUpdateState($id = 0)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = $this->getModelById($id);

        if ($this->isModelLoaded($model)) {

            if(!$model->isCanceled && $model->cancel_reason_id)
                $model->cancel_reason_id = null;

            $saved =  $model->save();
            return ['success' => $saved, 'needModal' => true, 'pjax_id' => 'status_pjax'];
        }
        return [];
    }


    public function actionChangeFormat($format_id = 0)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $res = Frame::getList($format_id, true, true);

        return ['id' => 'cartitem-frame_id', 'items' =>  $res];
    }

    public function actionChangeFrame($frame_id = 0)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $res = Mount::getPossibleMounts($frame_id);
        return ['id' => 'cartitem-mount_id', 'items' =>  $res, 'without_prompt' => true];
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
