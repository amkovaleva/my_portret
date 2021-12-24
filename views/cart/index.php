<?php

use app\models\base\Price;
use yii\helpers\Url;

foreach ($items as $key => &$item) {
    $accumulator = isset($total[$item->currency]) ? $total[$item->currency] : 0;
    $total[$item->currency] = $accumulator + $item->cost;
}
$total_info = array_map(function (&$cost, $currency) {
    return Price::getPriceStr($cost, $currency);
}, $total, array_keys($total));
?>

<h1><?= $this->title ?></h1>

<?= $this->render('//cart/_cart', ['items' => $items, 'total_info' => $total_info]) ?>

<div id="modal-del-container" data-load-modal-url="<?= Url::to(['cart/load-del-modal']) ?>"
     data-del-url="<?= Url::to(['cart/delete']) ?>"></div>
