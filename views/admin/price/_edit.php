<?php

use app\models\base\BackgroundMaterial;
use app\models\base\Format;
use app\models\base\PaintMaterial;
use app\models\base\PortraitType;
use yii\helpers\ArrayHelper;

?>

<div class="row">
    <div class="col">
        <?= $form->field($model, 'bg_material_id')->dropDownList(ArrayHelper::map(BackgroundMaterial::find()->asArray()->all(), 'id', 'name'),
            array('prompt' => Yii::t('admin/base', 'empty_list'))); ?>

    </div>
    <div class="col">
        <?= $form->field($model, 'portrait_type_id')->dropDownList(ArrayHelper::map(PortraitType::find()->asArray()->all(), 'id', 'name'),
            array('prompt' => Yii::t('admin/base', 'empty_list'))); ?>
    </div>
    <div class="col">
        <?= $form->field($model, 'paint_material_id')->dropDownList(ArrayHelper::map(PaintMaterial::find()->asArray()->all(), 'id', 'name'),
            array('prompt' => Yii::t('admin/base', 'empty_list'))); ?>
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
            array('prompt' => Yii::t('admin/base', 'empty_list'))); ?>
    </div>
    <div class="col"> &nbsp;</div>
    <div class="col">

        <?= $this->render('//admin/partials/_edit_btns', ['model' => $model]) ?>
    </div>
</div>
