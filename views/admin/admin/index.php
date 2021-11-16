<?php

use yii\helpers\Url;

$models = array('prices', 'colours', 'formats', 'mounts', 'frames', 'background-colours', 'background-materials', 'paint-materials', 'portrait-types');
$text_go = Yii::t('admin/base', 'text_go')
?>

<h1>Тут будет информация о заказах, а пока...</h1>

<div class="row m-4">
    <?php foreach ($models

    as $key => &$model_name) {
    $title = Yii::t('admin/' . $model_name, 'title');
    $description = Yii::t('admin/' . $model_name, 'description');
    $url = Url::to('/admin/' . $model_name);
    ?>
    <?php if ($key % 2 == 0){ ?>
</div>
<div class="row m-4">
    <?php } ?>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?= $title ?></h5>
                <p class="card-text"><?= $description?></p>
                <a href="<?= $url ?>" class="btn btn-primary"><?= $text_go ?></a>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
