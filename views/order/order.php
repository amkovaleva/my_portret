<?php

use app\models\base\Currency;
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
                        <?= $this->render('_material_widget', ['model' => $model, 'availableMaterials' => $availableMaterials,
                            'main_class' => 'tool', 'display' => 'button', 'field_name' => 'material_id']) ?>
                    </div>
                    <div class="materials__surfaces-choice">
                        <?= $this->render('_material_widget', ['model' => $model, 'availableMaterials' => $model->availableBases,
                            'main_class' => 'surface', 'display' => 'tab', 'field_name' => 'base_id']) ?>
                    </div>
                </div>
            </div>

            <?= $this->render('_select_widget', [
                'model' => $model, 'form' => $form, 'list' => $model->availableFormats,
                'class_name' => 'portrait-size', 'field_name' => 'format_id'
            ]) ?>


            <?php
            $availableFacesCounts = $model->availableFacesCounts;
            $total = [$availableFacesCounts[$model->faces_count][1]];
            ?>

            <?= $this->render('_select_widget', [
                'model' => $model, 'form' => $form, 'list' => $availableFacesCounts,
                'class_name' => 'people', 'field_name' => 'faces_count'
            ]) ?>


            <?= $this->render('_colour_picker_widget', [
                'model' => $model, 'colours_list' => $model->availableBgColours,
                'class_name' => 'order__background', 'field_name' => 'background_color_id'
            ]) ?>


            <?= $this->render('_select_widget', [
                'model' => $model, 'form' => $form, 'list' => $model->availableFrameFormats,
                'class_name' => 'frame-size', 'field_name' => 'frame_format_id'
            ]) ?>

            <?= $this->render('_colour_picker_widget', [
                'model' => $model, 'colours_list' => $model->availableFrames,
                'class_name' => 'order__frame-color', 'field_name' => 'frame_id'
            ]) ?>

            <?= $this->render('_colour_picker_widget', [
                'model' => $model, 'colours_list' => $model->availableMounts,
                'class_name' => 'order__mat', 'field_name' => 'mount_id'
            ]) ?>

            <?= $this->render('_addons', ['addons' => $addons]) ?>

            <div class="order__side-submit">
                <button class="button" type="button">
                    <?= Yii::t('app/orders', 'add') ?>
                </button>
            </div>
        </div>
        <?= $this->render('_preview', ['total' => $total]) ?>
    </div>

<?php ActiveForm::end(); ?>
