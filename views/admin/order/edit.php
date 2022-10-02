<?php

use app\assets\AdminAsset;
use yii\widgets\Pjax;
?>

<div class="row bordered">
    <div class="col-md-6">
        <h1><?= Yii::t('admin/orders', 'edit_title') ?> №<?= $model->id ?></h1>
        <a href='<?= $model->fullPhotoUrl ?>'><img src='<?= $model->previewPhotoUrl ?>' class='photo_preview'></a>
        <h6><?= Yii::t('admin/orders', 'created_string') .  Yii::$app->formatter->asDate($model->created_at, 'php:d.m.Y  H:m') ?> </h6>
    </div>
    <div class="col-md-6">

        <?php Pjax::begin(['id' => 'status_pjax', 'options' => ['neverTimeout' => true]]) ?>
        <?= $this->render('_edit_status', ['model' => $model]) ?>
        <?php Pjax::end() ?>
    </div>
</div>

<?= $this->render('_edit_portrait_info', ['model' => $model->cartItem]) ?>
<?= $this->render('_edit_contact_info', ['model' => $model]) ?>
<?= $this->render('_saved_modal') ?>

<?php
$this->registerJsFile("@web/js/admin_order.js",[ 'depends' => [ AdminAsset::className() ] ]);
?>