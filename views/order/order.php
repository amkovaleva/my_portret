<?php

use app\models\base\Format;
use app\models\base\Mount;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin([
    'id' => 'order-form',
    'method' => 'POST',
    'action' => Url::to(['/order/create']),
    'enableAjaxValidation' => false,
    'enableClientValidation' => false,
    'options'=> ['change_action' => Url::to(['/order/change'])]
]); ?>
<h1><?= Yii::t('app/orders', 'title')?></h1>
<div class="data-container">
    <?= $this->render('/order/_preview', [ 'model' => $model, 'form' => $form ]) ?>
    <div class="form">
        <?= $this->render('/order/_main_options',  [ 'model' => $model, 'form' => $form ]) ?>
        <?= $this->render('/order/_style_options', [ 'model' => $model, 'form' => $form ]) ?>
        <div style="display: none" id="validation">
            <?= Yii::t('app/orders',  'miss_image') ?>
        </div>
        <?= Html::submitButton( Yii::t('app/orders',  'to_cart')) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

<?php
$formats =  json_encode(Format::find()->indexBy('id')->asArray()->all());
$mounts =  json_encode(Mount::find()->indexBy('id')->asArray()->all());
$script = <<< JS
    window.frameSizes = $formats;
    window.mountInfos = $mounts;
JS;
$this->registerJs($script);
?>
<script>
</script>
