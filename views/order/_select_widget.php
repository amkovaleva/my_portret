<div class="order__<?= $class_name ?>">
    <div class="label">
        <?= Yii::t('app/orders', $field_name) ?>
    </div>
    <?= $form->field($model, $field_name)->hiddenInput()->label(false) ?>
    <div class="select">
        <?= $this->render('_select_control', ['model' => $model, 'list' => $list, 'field_name' => $field_name]) ?>
    </div>
</div>