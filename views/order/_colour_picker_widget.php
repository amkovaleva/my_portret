
<div class="<?= $class_name?>">
    <div class="color-picker">
        <div class="color-picker__heading title title--smaller">
            <?= Yii::t('app/orders', $field_name) ?>
        </div>
        <?php
        $mount_color = $list[ $model->$field_name][1];
        ?>
        <div class="color-picker__list">
            <?= $this->render('_colour_picker_buttons', ['model' => $model, 'list' => $list, 'field_name' => $field_name]) ?>
        </div>
        <div class="color-picker__output">
            <?= $mount_color ?>
        </div>
    </div>
</div>