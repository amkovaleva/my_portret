<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin([
    'id' => 'edit-form',
    'method' => 'POST',
    'action' =>  Url::to(["/admin/format/update", 'id' => $model->id]),
    'enableAjaxValidation' => true,
    'validationUrl' => Url::to(["/admin/format/validate", 'id' => $model->id]),
]); ?>

<?= $form->field($model, 'name') ?>
<?= $form->field($model, 'length')->textInput(['type' => 'number']) ?>
<?= $form->field($model, 'width')->textInput(['type' => 'number']) ?>

<?= $form->field($model, 'id')->hiddenInput()->label(false) ?>

<div class="form-group">
    <?= Html::submitButton( Yii::t('admin/base', $model->getIsNewRecord() ? 'create' : 'update') , ['class' => 'btn btn-primary']) ?>

<?php
if(!$model->getIsNewRecord())
    echo Html::button( Yii::t('admin/base', 'clear'), ['class' => 'btn btn-secondary']);
?>
</div>

<?php ActiveForm::end(); ?>