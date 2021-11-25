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
        <!-- <?= $this->render('/order/_preview', [ 'model' => $model, 'form' => $form ]) ?> -->
    </div>
    <div class="col-lg-6">
        <?= $this->render('/order/_main_options',  [ 'model' => $model, 'form' => $form ]) ?>
        <?= $this->render('/order/_style_options', [ 'model' => $model, 'form' => $form ]) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

<script>
    window.frameSizes = <?=  json_encode(Format::find()->indexBy('id')->asArray()->all())?>
</script>
