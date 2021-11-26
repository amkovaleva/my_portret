
<div class="card">
    <div class="card-body">
        <h5 class="card-title"><?= Yii::t('app/orders', 'title_decor') ?></h5>
        <div class="card-text">
            <?= $form->field($model, 'frame_format_id')->radioList($model->availableFrameFormats) ?>
            <?= $form->field($model, 'mount_id')->radioList($model->availableMounts,
                [
                    'item' => function ($index, $label, $name, $checked, $value) {

                        $checked_str = $checked ? ' checked' : '';
                        $return = '<label class="round" style="background: '
                            . $label .'"><input type="radio" name="' . $name . '" value="' . $value . '"'. $checked_str .'></label>';

                        return $return;
                    }
                ]) ?>
            <?= $form->field($model, 'frame_id')->radioList($model->availableFrames,
                [
                    'item' => function ($index, $label, $name, $checked, $value) {

                $checked_str = $checked ? ' checked' : '';
                        $return = '<label class="round" style="background: '
                            . $label .'"><input type="radio" name="' . $name . '" value="' . $value . '"'. $checked_str .'></label>';

                        return $return;
                    }
                ]) ?>
        </div>
    </div>
</div>