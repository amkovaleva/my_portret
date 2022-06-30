<?php

use app\models\base\Format;
use app\models\base\Frame;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'order-form',
    'method' => 'POST',
    'enableAjaxValidation' => false,
    'enableClientValidation' => false,
    'options' => ['change_action' => Url::to(['order/change'])]
]); ?>

<?= $form->field($model, 'portrait_type_id')->hiddenInput()->label(false) ?>
    <div class="order">
        <div class="order__sidebar">
            <div class="order__currency">
                <?= $this->render('/partials/_currency') ?>
            </div>
            <div class="order__uploading-hint">
                <button class="upload" type="button">
                    <?= Yii::t('app/orders', 'upload_btn_text') ?>
                </button>
            </div>
            <div class="order__tools-selection">
                <div class="materials">
                    <?php
                    $availableMaterials = $model->availableMaterials;
                    $material_name = $availableMaterials[$model->material_id];
                    ?>
                    <div class="materials__output title title--smallest">
                        <?= $material_name ?>
                    </div>
                    <div class="materials__tools-choice">
                        <?= $this->render('_material_tools', ['model' => $model, 'availableMaterials' => $availableMaterials]) ?>
                    </div>
                    <div class="materials__surfaces-choice">
                        <?= $this->render('_material_surface', ['model' => $model]) ?>
                    </div>
                </div>
            </div>
            <div class="order__portrait-size">
                <div class="label">
                    <?= Yii::t('app/orders', 'portrait_size') ?>
                </div>
                <?= $form->field($model, 'format_id')->hiddenInput()->label(false) ?>
                <div class="select">
                    <?= $this->render('_portrait_size', ['model' => $model]) ?>
                </div>
            </div>
            <div class="order__people">
                <div class="label">
                    <?= Yii::t('app/orders', 'faces_count') ?>
                </div>
                <?= $form->field($model, 'faces_count')->hiddenInput()->label(false) ?>
                <div class="select">
                    <?= $this->render('_faces_count', ['model' => $model]) ?>
                </div>
            </div>

            <?= $this->render('_colour_picker', [
                'model' => $model, 'colours_list' => $model->availableBgColours,
                'class_name' => 'order__background', 'field_name' => 'background_color_id'
            ]) ?>

            <div class="order__frame-size">
                <div class="label">
                    <?= Yii::t('app/orders', 'frame_size') ?>
                </div>
                <?= $form->field($model, 'frame_format_id')->hiddenInput()->label(false) ?>
                <div class="select">
                    <?= $this->render('_frame_sizes', ['model' => $model]) ?>
                </div>
            </div>

            <?= $this->render('_colour_picker', [
                'model' => $model, 'colours_list' => $model->availableFrames,
                'class_name' => 'order__frame-color', 'field_name' => 'frame_id'
            ]) ?>

            <?= $this->render('_colour_picker', [
                'model' => $model, 'colours_list' => $model->availableMounts,
                'class_name' => 'order__mat', 'field_name' => 'mount_id'
            ]) ?>

            <?= $this->render('_addons') ?>

            <div class="order__side-submit">
                <button class="button" type="button">
                    <?= Yii::t('app/orders', 'add') ?>
                </button>
            </div>
        </div>

        <?= $this->render('_preview') ?>
    </div>

<?php ActiveForm::end(); ?>

<?php
$formats = json_encode(Format::find()->indexBy('id')->asArray()->all());
$frames = json_encode(Frame::find()->indexBy('id')->asArray()->all());
$format_id = $model->format_id;

$script = <<< JS
    window.formatSizes = $formats;
    window.frameInfos = $frames;
    setUpFormat($format_id);
JS;
$this->registerJs($script);
?>