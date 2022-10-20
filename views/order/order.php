<?php

use app\models\OrderConsts;
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
<?= $form->field($model, 'user_cookie')->hiddenInput()->label(false) ?>
<?= $form->field($model, 'cost')->hiddenInput()->label(false) ?>
<?= $form->field($model, 'crop_data')->hiddenInput()->label(false) ?>

    <div class="order">
        <div class="order__sidebar">
            <div class="order__currency">
                <?= $this->render('/partials/_currency') ?>
            </div>
            <div class="order__uploading-hint">
                <?= $form->field($model, 'image')->fileInput(['accept' => 'image/jpeg,image/png,image/bmp'])->label(false) ?>
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
                    <?= $this->render('_material_widget', array_merge(['model' => $model, 'list' => $availableMaterials],
                        OrderConsts::FIELD_RENDER_PARAMS[OrderConsts::PAINT_MATERIAL])) ?>

                    <?= $this->render('_material_widget',  array_merge(['model' => $model, 'list' => $model->availableBases],
                        OrderConsts::FIELD_RENDER_PARAMS[OrderConsts::BG_MATERIAL])) ?>
                </div>
            </div>

            <?= $this->render('_select_widget',  array_merge(['model' => $model, 'list' => $model->availableFormats],
                OrderConsts::FIELD_RENDER_PARAMS[OrderConsts::FORMAT])) ?>

            <?php
            $availableFacesCounts = $model->availableFacesCounts;
            $total = [$availableFacesCounts[$model->faces_count][1]];
            ?>

            <?= $this->render('_select_widget', array_merge(['model' => $model, 'list' => $availableFacesCounts],
                OrderConsts::FIELD_RENDER_PARAMS[OrderConsts::FACES])) ?>

            <?= $this->render('_colour_picker_widget', [
                'model' => $model, 'list' => $model->availableBgColours,
                'class_name' => 'order__background', 'field_name' => 'background_color_id'
            ]) ?>

            <?= $this->render('_select_widget', array_merge(['model' => $model, 'list' => $model->availableFrameFormats],
                OrderConsts::FIELD_RENDER_PARAMS[OrderConsts::FRAME_FORMAT])) ?>

            <?= $this->render('_colour_picker_widget', array_merge(['model' => $model, 'list' => $model->availableFrames],
                OrderConsts::FIELD_RENDER_PARAMS[OrderConsts::FRAME])) ?>

            <?= $this->render('_colour_picker_widget', array_merge(['model' => $model, 'list' => $model->availableMounts],
                OrderConsts::FIELD_RENDER_PARAMS[OrderConsts::MOUNT])) ?>

            <?= $this->render('_addons', ['addons' => $addons]) ?>

            <div class="order__side-submit">
                <input class="button" type="submit" value="<?= Yii::t('app/orders', 'add') ?>">
            </div>
        </div>
        <?= $this->render('_preview', ['total' => $total]) ?>
    </div>

<?php ActiveForm::end(); ?>

<?= $this->render('_crop_wnd', ['model' => $model]) ?>

<?= $this->render('/partials/_modal', ['title' => Yii::t('app/orders', 'no_image_title'),
    'message' => Yii::t('app/orders', 'no_image_message'),
    'button' => Yii::t('app/orders', 'no_image_cancel'),
    'hidden' => true,
    'id' => 'image_validation']) ?>

