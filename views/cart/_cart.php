<?php

use app\models\base\Price;

$total = [];
?>

<?php foreach ($items as $key => &$item) {
    $accumulator = isset($total[$item->currency]) ? $total[$item->currency] : 0;
    $total[$item->currency] = $accumulator + $item->cost;
    ?>
    <?= $this->render('//cart/_cart_item', ['key' => $key, 'item' => $item]) ?>
<?php }
$total_info = array_map(function (&$cost, $currency) {
    return Price::getPriceStr($cost, $currency);
}, $total, array_keys($total));
?>
<div><?= Yii::t('app/carts', 'total') ?> :<?= implode(" + ", $total_info) ?></div>
