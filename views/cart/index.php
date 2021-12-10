<?php

use yii\helpers\Url;

?>
<h1><?= $this->title ?></h1>

<?= $this->render('//cart/_cart', ['items' => $items]) ?>

<div id="modal-del-container" data-load-modal-url="<?= Url::to(['cart/load-del-modal']) ?>"
     data-del-url="<?= Url::to(['cart/delete']) ?>"></div>
