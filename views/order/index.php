<?php

use app\models\base\Format;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'order-form',
    'method' => 'POST',
    'action' => Url::to(['/order/create']),
    'options'=> ['change_action' => Url::to(['/order/change'])],
]); ?>
<h1><?= Yii::t('app/orders', 'title')?></h1>
<div class="row">
    <div class="col-lg-6">
        <div id="preview">
            <div id="upload-content">
                <?= $form->field($model, 'image')->fileInput()->label(false) ?>
                <div id="drop-zone">
                    DROP HERE
                </div>
            </div>
            <div id="image-content" data-alt="<?= Yii::t('app/orders', 'img_alt')?>"></div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card" id="main-settings">
            <div class="card-body">
                <h5 class="card-title"><?= Yii::t('app/orders', 'title_main') ?></h5>
                <div class="card-text">
                    <?= $form->field($model, 'portrait_type_id')->radioList($model->availablePortraitTypes) ?>
                    <?= $form->field($model, 'material_id')->radioList($model->availableMaterials) ?>
                    <?= $form->field($model, 'base_id')->radioList($model->availableBases) ?>
                    <?= $form->field($model, 'format_id')->radioList($model->availableFormats) ?>
                </div>
                <?= $form->field($model, 'cost')->textInput(['id' => 'cost', 'readonly' => true]) ?>
            </div>
        </div>
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
    </div>
</div>

<?php ActiveForm::end(); ?>

<script>
    window.frameSizes = <?=  json_encode(Format::find()->indexBy('id')->asArray()->all())?>
</script>
