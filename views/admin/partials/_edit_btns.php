<?php

use yii\helpers\Html;

?>

<div class="form-group">
    <?= Html::submitButton( Yii::t('admin/base', $model->getIsNewRecord() ? 'create' : 'update') , ['class' => 'btn btn-primary']) ?>

    <?php
    if(!$model->getIsNewRecord())
        echo Html::button( Yii::t('admin/base', 'clear'), ['class' => 'btn btn-secondary']);
    ?>

</div>
