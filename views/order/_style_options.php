
<div class="card">
    <div class="card-body">
        <h5 class="card-title"><?= Yii::t('app/orders', 'title_decor') ?></h5>
        <div class="card-text">
            <?= $form->field($model, 'background_color_id')->radioList($model->availableBgColours) ?>
            <?= $form->field($model, 'frame_format_id')->radioList($model->availableFrameFormats) ?>
            <?= $form->field($model, 'mount_id')->radioList($model->availableMounts) ?>
            <?= $form->field($model, 'frame_id')->radioList($model->availableFrames) ?>
        </div>
    </div>
</div>