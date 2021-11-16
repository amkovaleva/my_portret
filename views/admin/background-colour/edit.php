<?php

use app\models\base\Colour;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin([
    'id' => 'edit-form',
    'method' => 'POST',
    'action' =>  Url::to(["/admin/background-colour/update", 'id' => $model->id]),
    'enableAjaxValidation' => true,
    'validationUrl' => Url::to(["/admin/background-colour/validate", 'id' => $model->id]),
]); ?>


<?= $form->field($model, 'colour_id')->dropDownList(ArrayHelper::map(Colour::find()->asArray()->all(), 'id', 'name'),
    array('prompt'=>Yii::t('admin/base', 'empty_list')) ); ?>

<?= $form->field($model, 'id')->hiddenInput()->label(false) ?>

<div class="form-group">
    <?= Html::submitButton( Yii::t('admin/base', $model->getIsNewRecord() ? 'create' : 'update') , ['class' => 'btn btn-primary']) ?>

<?php
if(!$model->getIsNewRecord())
    echo Html::button( Yii::t('admin/base', 'clear'), ['class' => 'btn btn-secondary']);
?>

</div>

<?php ActiveForm::end(); ?>