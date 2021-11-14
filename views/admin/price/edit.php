<?php

use app\models\base\BackgroundMaterial;
use app\models\base\Format;
use app\models\base\PaintMaterial;
use app\models\base\PortraitType;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
<?php $form = ActiveForm::begin([
    'id' => 'edit-form',
    'method' => 'POST',
    'action' => Url::to(["/admin/price/update", 'id' => $model->id]),
    'enableAjaxValidation' => true,
    'enableClientValidation' => false,
    'validationUrl' => Url::to(["/admin/price/validate", 'id' => $model->id]),
]); ?>

    <div class="row">
        <div class="col">
            <?= $form->field($model, 'bg_material_id')->dropDownList(ArrayHelper::map(BackgroundMaterial::find()->asArray()->all(), 'id', 'name'),
                array('prompt'=>Yii::t('admin/base', 'empty_list')) ); ?>

        </div>
        <div class="col">
            <?= $form->field($model, 'portrait_type_id')->dropDownList(ArrayHelper::map(PortraitType::find()->asArray()->all(), 'id', 'name'),
                array('prompt'=>Yii::t('admin/base', 'empty_list')) ); ?>
        </div>
        <div class="col">
            <?= $form->field($model, 'paint_material_id')->dropDownList(ArrayHelper::map(PaintMaterial::find()->asArray()->all(), 'id', 'name'),
                array('prompt'=>Yii::t('admin/base', 'empty_list')) ); ?>

            <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>



        </div>
    </div>
<div class="row">
    <div class="col">
        <?= $form->field($model, 'price')->textInput(['type' => 'number']) ?>
    </div>
    <div class="col">
        <?= $form->field($model, 'price_usd')->textInput(['type' => 'number']) ?>
    </div>
    <div class="col">
        <?= $form->field($model, 'price_eur')->textInput(['type' => 'number']) ?>
    </div>
</div>
<div class="row">
    <div class="col">
        <?= $form->field($model, 'format_id')->dropDownList(ArrayHelper::map(Format::find()->asArray()->all(), 'id', 'name'),
            array('prompt'=>Yii::t('admin/base', 'empty_list')) ); ?>
    </div>
    <div class="col"> &nbsp;</div>
    <div class="col">
        <div class="form-group">
            <?= Html::submitButton(Yii::t('admin/base', $model->getIsNewRecord() ? 'create' : 'update'), ['class' => 'btn btn-primary']) ?>

            <?php
            if (!$model->getIsNewRecord())
                echo Html::button(Yii::t('admin/base', 'clear'), ['class' => 'btn btn-secondary']);
            ?>

        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>