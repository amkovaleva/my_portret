<?php
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$dir = '/admin/'. $model_name;

$default = isset($default) ? $default : true;
$with_btns = isset($with_btns) ? $with_btns : true;
?>
<?php $form = ActiveForm::begin([
    'id' => 'edit-form',
    'method' => 'POST',
    'action' =>  Url::to([$dir . '/update', 'id' => $model->id]),
    'enableAjaxValidation' => true,
    'validationUrl' => Url::to([$dir . "/validate", 'id' => $model->id]),
    'options' => ['enctype'=>'multipart/form-data']
]); ?>


<?php if($default){ ?>
    <?= $form->field($model, 'name') ?>
<?php } else { ?>
    <?= $this->render($dir .'/_edit', ['model' => $model, 'form' => $form]) ?>
<?php }?>


<?= $form->field($model, 'id')->hiddenInput()->label(false) ?>

<?php if($with_btns){ ?>
    <?= $this->render('//admin/partials/_edit_btns', ['model' => $model]) ?>
<?php }?>

<?php ActiveForm::end(); ?>