<?php

use app\models\OrderConsts;

?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title"><?= Yii::t('app/orders', 'title_decor') ?></h5>
        <div class="card-text">
            <?= $form->field($model, 'frame_format_id')->dropDownList($model->availableFrameFormats,
                [
                    'changed-field' => OrderConsts::FRAME_FORMAT,
                    'prompt' => [
                        'text' => OrderConsts::getFieldPrompt(OrderConsts::FRAME_FORMAT),
                        'options' => ['value' => 0]
                    ]
                ]) ?>
            <?= $form->field($model, 'frame_id', ['options' => ['style' => 'display: none']])->radioList($model->availableFrames,
                [
                    'item' => function ($index, $label, $name, $checked, $value) {

                        $checked_str = $checked ? ' checked' : '';
                        $return = '<label class="round" style="background: '
                            . $label . '"><input type="radio" name="' . $name . '" value="' . $value . '"' . $checked_str . '></label>';

                        return $return;
                    }, 'changed-field' => OrderConsts::FRAME,
                ]) ?>
            <?= $form->field($model, 'mount_id', ['options' => ['style' => 'display: none']])->radioList($model->availableMounts,
                [
                    'item' => function ($index, $label, $name, $checked, $value) {

                        $checked_str = $checked ? ' checked' : '';
                        $return = '<label class="round" style="background: '
                            . $label . '"><input type="radio" name="' . $name . '" value="' . $value . '"' . $checked_str . '></label>';

                        return $return;
                    },
                ]) ?>
        </div>
    </div>
</div>