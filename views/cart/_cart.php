
<?php foreach ($items as $key => &$item) { ?>
    <?= $this->render('//cart/_cart_item', ['key' => $key, 'item' => $item]) ?>
<?php } ?>
<div><?= Yii::t('app/carts', 'total') ?>: <?= implode(" + ", $total_info) ?></div>
