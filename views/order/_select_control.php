<?php
$is_one_column = count($list) && is_string($list[$model->$field_name]);
?>
<button class="select__handler" type="button">
    <?= $this->render('_select_item', ['key' => $model->$field_name, 'item' => $list[$model->$field_name],
        'is_one_column' => $is_one_column, 'empty_string' => Yii::t('app/orders', 'empty_'. $field_name)]) ?>
</button>
<div class="select__body">
    <?php foreach ($list as $key => $item) { ?>
        <button class="select__item <?= $key == $model->$field_name ? ' select__item--current' : '' ?>" type="button" data-id="<?= $key ?>">
            <?= $this->render('_select_item', ['key' => $key, 'item' => $item,
                'is_one_column' => $is_one_column, 'empty_string' => Yii::t('app/orders', 'empty_'. $field_name)]) ?>
        </button>
    <?php } ?>
</div>