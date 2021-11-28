<?php

use app\models\OrderConsts;

?>

<?= $form->field($model, 'frame_format_id')->dropDownList($model->availableFrameFormats,
    [
        'changed-field' => OrderConsts::FRAME_FORMAT,
        'prompt' => [
            'text' => OrderConsts::getFieldPrompt(OrderConsts::FRAME_FORMAT),
            'options' => ['value' => 0]
        ]
    ]) ?>
<?= $form->field($model, 'frame_id', ['options' => ['style' => $model->mount_id ? 'frame_id' : 'display: none']])->radioList($model->availableFrames,
    [
        'item' => function ($index, $label, $name, $checked, $value) {

            $checked_str = $checked ? ' checked' : '';
            $return = '<label class="round" style="background: '
                . $label . '"><input type="radio" name="' . $name . '" value="' . $value . '"' . $checked_str . '></label>';

            return $return;
        }, 'changed-field' => OrderConsts::FRAME,
    ]) ?>
<?= $form->field($model, 'mount_id', ['options' => ['style' => $model->mount_id ? '' : 'display: none']])->radioList($model->availableMounts,
    [
        'item' => function ($index, $label, $name, $checked, $value) {

            $checked_str = $checked ? ' checked' : '';
            $return = '<label class="round" style="background: '
                . $label . '"><input type="radio" name="' . $name . '" value="' . $value . '"' . $checked_str . '></label>';

            return $return;
        },
    ]) ?>