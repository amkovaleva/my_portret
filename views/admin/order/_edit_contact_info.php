<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin([
    'id' => 'contact-form',
    'method' => 'POST',
    'action' =>  Url::to(['/admin/order/update', 'id' => $model->id]),
    'enableAjaxValidation' => true,
    'validationUrl' => Url::to(["/admin/order/validate", 'id' => $model->id]),
    'options' => ['enctype'=>'multipart/form-data', 'class'=> 'bordered']
]); ?>

<?= $form->field($model, 'id')->hiddenInput()->label(false) ?>

<h2><?= Yii::t('admin/orders', 'edit_contact_info') ?></h2>
<div class="row">
    <div class="col-sm-12 col-md-4">
        <?= $form->field($model, 'last_name'); ?>
    </div>
    <div class="col-sm-12 col-md-4">
        <?= $form->field($model, 'first_name'); ?>
    </div>
    <div class="col-sm-12 col-md-4">
        <?= $form->field($model, 'middle_name'); ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-6">
        <?= $form->field($model, 'email'); ?>
    </div>
    <div class="col-sm-12 col-md-6">
        <?= $form->field($model, 'phone'); ?>
    </div>
</div>

<h2><?= Yii::t('admin/orders', 'edit_address_info') ?></h2>

<div class="row">
    <div class="col-sm-12 col-md-4">
        <?= $form->field($model, 'country'); ?>
    </div>
    <div class="col-sm-12 col-md-4">
        <?= $form->field($model, 'city'); ?>
    </div>
    <div class="col-sm-12 col-md-4">
        <?= $form->field($model, 'street'); ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-4">
        <?= $form->field($model, 'house'); ?>
    </div>
    <div class="col-sm-12 col-md-4">
        <?= $form->field($model, 'apartment'); ?>
    </div>
    <div class="col-sm-12 col-md-4">
        <?= $form->field($model, 'index'); ?>
    </div>
</div>

<div class="form-group">
    <?= Html::submitButton( Yii::t('admin/base', 'update') , ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>

