
<?= $form->field($model, 'name') ?>
<?= $form->field($model, 'name_en') ?>
<?= $form->field($model, 'description')->textarea() ?>
<?= $form->field($model, 'description_en')->textarea() ?>
<?= $form->field($model, 'for_ru')->checkbox() ?>
<?= $form->field($model, 'for_not_ru')->checkbox() ?>