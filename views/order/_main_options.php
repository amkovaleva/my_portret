<?php

use app\models\OrderConsts;
?>

<div class="card" id="main-settings">
    <div class="card-body">
        <h5 class="card-title"><?= Yii::t('app/orders', 'title_main') ?></h5>
        <div class="card-text">
            <?= $form->field($model, 'portrait_type_id')
                ->dropDownList($model->availablePortraitTypes, ['changed-field' => OrderConsts::PORTRAIT_TYPE]) ?>
            <?= $form->field($model, 'material_id')->dropDownList($model->availableMaterials, ['changed-field' => OrderConsts::PAINT_MATERIAL]) ?>
            <?= $form->field($model, 'base_id')->dropDownList($model->availableBases, ['changed-field' => OrderConsts::BG_MATERIAL]) ?>
            <?= $form->field($model, 'format_id')->radioList($model->availableFormats, ['changed-field' => OrderConsts::FORMAT]) ?>
        </div>
        <?= $form->field($model, 'cost')->textInput(['id' => 'cost', 'readonly' => true]) ?>
    </div>
</div>