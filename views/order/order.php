<?php

use app\models\base\Format;
use app\models\base\Frame;
use app\models\base\Mount;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'order-form',
    'method' => 'POST',
    'enableAjaxValidation' => false,
    'enableClientValidation' => false,
    'options' => ['change_action' => Url::to(['order/change'])]
]); ?>
    <h1><?= Yii::t('app/orders', 'title') ?></h1>
<?php if ($save_result !== null) { ?>
    <h3><?= Yii::t('app/orders', ($save_result ? '' : 'not_') . 'saved') ?></h3>
<?php } ?>
    <div class="data-container">
        <div id="preview">
            <div id="frame-content" class="no-image <?= $model->frameImageUrl ? 'with-frame' : '' ?>"
                 data-alt="<?= Yii::t('app/orders', 'img_alt') ?>">
                <div id="upload-content">
                    <?= $form->field($model, 'image')->fileInput()->label(false) ?>
                    <div id="drop-zone">
                        DROP HERE
                    </div>
                </div>
                <img src="<?= $model->frameImageUrl ?>" alt="<?= Yii::t('app/orders', 'frame') ?>" class="frame"/>
            </div>
            <input type="button" id="clear" value="<?= Yii::t('app/orders', 'clear') ?>">
            <input type="button" id="change-orientation" value="<?= Yii::t('app/orders', 'change_orientation') ?>">
            <input type="button" id="change-area" value="<?= Yii::t('app/orders', 'change_area') ?>">
        </div>
        <div class="form">
            <?= $this->render('/order/_main_options', ['model' => $model, 'form' => $form]) ?>
            <?= $this->render('/order/_style_options', ['model' => $model, 'form' => $form]) ?>
            <div style="display: none" id="validation">
                <?= Yii::t('app/orders', 'miss_image') ?>
            </div>
            <?= Html::submitButton(Yii::t('app/orders', 'to_cart')) ?>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="crop-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
         data-keyboard="false" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel"> <?= Yii::t('app/orders', 'cropper_title') ?></h5>
                </div>
                <div class="modal-body">
                    <img src="#" alt="<?= Yii::t('app/orders', 'crop_alt') ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal"> <?= Yii::t('app/orders', 'cropper_apply') ?></button>
                </div>
            </div>
        </div>
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