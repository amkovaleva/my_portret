<?php

use app\models\base\Frame;
use app\models\base\FrameMountImage;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
<?php $form = ActiveForm::begin([
    'id' => 'edit-form',
    'method' => 'POST',
    'action' => Url::to(["/admin/frame-mount-image/update", 'id' => $model->id]),
    'enableAjaxValidation' => true,
    'validationUrl' => Url::to(["/admin/frame-mount-image/validate", 'id' => $model->id]),
    'options' => ['enctype' => 'multipart/form-data']
]); ?>


<?= $form->field($model, 'frame_id')
    ->dropDownList(ArrayHelper::map(Frame::find()->asArray()->all(), 'id', 'name'),
    array('prompt' => Yii::t('admin/base', 'empty_list'), 'change_url' => Url::to(["/admin/frame-mount-image/change"]))); ?>
<?= $form->field($model, 'mount_id')->dropDownList( ArrayHelper::map(FrameMountImage::getMounts($model->frame_id), 'id', 'name'),
    array('prompt' => Yii::t('admin/base', 'empty_list'))); ?>

<?= $form->field($model, 'image')->fileInput() ?>
<div class="form-group">
    <img src="<?= $model->imageUrl; ?>">
</div>
<?= $form->field($model, 'id')->hiddenInput()->label(false) ?>

<div class="form-group">
    <?= Html::submitButton(Yii::t('admin/base', $model->getIsNewRecord() ? 'create' : 'update'), ['class' => 'btn btn-primary']) ?>

    <?php
    if (!$model->getIsNewRecord())
        echo Html::button(Yii::t('admin/base', 'clear'), ['class' => 'btn btn-secondary']);
    ?>

</div>

<?php ActiveForm::end(); ?>
