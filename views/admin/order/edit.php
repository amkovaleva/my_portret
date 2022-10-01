<?php

use app\assets\AdminAsset;

?>

<h1><?= Yii::t('admin/orders', 'edit_title') ?> №<?= $model->id ?></h1>

<?= $this->render('_edit_portrait_info', ['model' => $model->cartItem]) ?>
<?= $this->render('_edit_contact_info', ['model' => $model]) ?>
<?= $this->render('_saved_modal') ?>

<?php
$this->registerJsFile("@web/js/admin_order.js",[ 'depends' => [ AdminAsset::className() ] ]);
?>