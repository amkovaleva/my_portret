<?php

use yii\helpers\Url;

$cats = Yii::$app->params['admin_models'];
$text_go = Yii::t('admin/base', 'text_go')
?>

<h1>Тут будет информация о заказах, а пока...</h1>

<div class="row m-4">
    <?php $ind = 0;
    foreach ($cats

    as $key => &$cat) {
    foreach ($cat

    as $key => &$model_name){

    $dir = 'admin/' . $model_name . 's';
    $title = Yii::t($dir, 'title');
    $description = Yii::t($dir, 'description');
    $url = Url::to('/' . $dir);

    if ($ind % 2 == 0){
    ?>

</div>
<div class="row m-4">
    <?php } ?>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?= $title ?></h5>
                <p class="card-text"><?= $description ?></p>
                <a href="<?= $url ?>" class="btn btn-primary"><?= $text_go ?></a>
            </div>
        </div>
    </div>
    <?php
    $ind++;
    }
    } ?>
</div>
