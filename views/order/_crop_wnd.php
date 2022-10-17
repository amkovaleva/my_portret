
<div class="shim" style="display:none" id="crop-modal">
    <div class="modal">
        <div class="modal__heading">Cropper</div>
        <div class="modal__content">
            <img src="#" alt="Picture">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>

<?php

use app\models\base\Format;
use app\models\base\Frame;
use app\models\base\Mount;

$formats =  json_encode(Format::find()->indexBy('id')->asArray()->all());
$mounts =  json_encode(Mount::find()->indexBy('id')->asArray()->all());
$frames =  json_encode(Frame::find()->indexBy('id')->asArray()->all());
$format_id =  $model->format_id;
$formats = json_encode(Format::find()->indexBy('id')->asArray()->all());
$frames = json_encode(Frame::find()->indexBy('id')->asArray()->all());
$format_id = $model->format_id;

$script = <<< JS
    window.frameSizes = $formats;
    window.mountInfos = $mounts;
    window.formatSizes = $formats;
    window.frameInfos = $frames;
    setUpFormat($format_id);
JS;
$this->registerJs($script);
?>

