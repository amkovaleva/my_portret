<?php

use app\assets\AdminAsset;

?>

<?= $this->render('_edit_status', ['model' => $model]) ?>
<?= $this->render('_edit_portrait_info', ['model' => $model->cartItem]) ?>
<?= $this->render('_edit_contact_info', ['model' => $model]) ?>
<?= $this->render('_saved_modal') ?>

<?php
$this->registerJsFile("@web/js/admin_order.js",[ 'depends' => [ AdminAsset::className() ] ]);
?>