<div class="order__<?= $class_name ?>">
    <div class="label">
        <?= Yii::t('app/orders', $field_name) ?>
    </div>
    <input type="hidden" name="CartItem[<?= $field_name ?>]" value="<?=$model->$field_name ?>" id="cartitem-<?= $field_name ?>">
    <div class="select">
        <?= $this->render('_select_control', ['model' => $model, 'list' => $list, 'field_name' => $field_name]) ?>
    </div>
</div>