<?php

use app\models\base\CancelReason;
use app\models\OrderConsts;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;

?>

<div>
    <?php
    $states = OrderConsts::statesForChange($model->state);
    $form = ActiveForm::begin([
        'id' => 'status-form',
        'method' => 'POST',
        'enableAjaxValidation' => true,
        'validationUrl' => Url::to(["/admin/order/validate", 'id' => $model->id]),
        'action' => Url::to(['/admin/order/update-state', 'id' => $model->id]),
        'options' => ['enctype' => 'multipart/form-data']
    ]);
    ?>

    <?= $form->field($model, 'state')->dropDownList($states); ?>

    <?php
    if (in_array(OrderConsts::CANCELED_STATE, array_keys($states))) { ?>
        <div <?= !$model->isCanceled ? 'style="display: none"' : '' ?> class="change-action">
            <?= $form->field($model, 'cancel_reason_id')
                ->dropDownList(
                    ArrayHelper::map(CancelReason::find()->asArray()->all(), 'id', 'name'),
                    ['data-show' => OrderConsts::CANCELED_STATE]); ?>
        </div>
    <?php } ?>

    <?php
    if (in_array(OrderConsts::IN_THE_WAY_STATE, array_keys($states))) { ?>
        <div <?= $model->state < OrderConsts::IN_THE_WAY_STATE ? 'style="display: none"' : '' ?> class="change-action">
            <?= $form->field($model, 'track_info')->textarea(['data-show' => OrderConsts::IN_THE_WAY_STATE]); ?>
        </div>
    <?php } ?>

    <?= $form->field($model, 'shop_comment')->textarea(); ?>
    <?= $form->field($model, 'user_comment')->textarea(); ?>

    <?= Html::submitButton(Yii::t('admin/base', 'update'), ['class' => 'btn btn-primary']) ?>

    <?php
    ActiveForm::end();
    ?>
</div>


<?php
$this->registerJs("init_change_status();", View::POS_LOAD);
?>