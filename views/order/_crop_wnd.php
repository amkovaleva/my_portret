
<div class="shim" style="display:none" id="crop-modal">
    <div class="modal">
        <div class="modal__heading"><?= Yii::t('app/orders', 'cropper_title') ?></div>
        <div class="modal__content">
            <div class="cropper_content">
                <img src="#" alt="Picture">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="button btn-secondary" data-dismiss="modal"><?= Yii::t('app/orders', 'cropper_apply') ?></button>
        </div>
    </div>
</div>

<?php

use app\models\base\Format;

$formats =  json_encode(Format::find()->indexBy('id')->asArray()->all());
$format_id =  $model->format_id;

$script = <<< JS
    window.formatSizes = $formats;
    setUpFormat($format_id);
JS;
$this->registerJs($script);
?>

