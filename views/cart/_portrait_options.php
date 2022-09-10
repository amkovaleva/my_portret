<?php
$trans_dir = 'app/carts';
$options = $item->portraitOptions;

$options[Yii::t($trans_dir, 'wrapping')] = Yii::t($trans_dir, 'included');
$options[Yii::t($trans_dir, 'delivery')] = Yii::t($trans_dir, 'included');

?>

<div class="basket__purchase cart">
    <h2 class="cart__heading title title--even-smaller">
        <?= $this->title ?>
    </h2>
    <div class="cart__summary sheet">

        <?php foreach ($options as $key => $option) { ?>
            <div class="sheet__row">
                <div class="sheet__param"><?=  $key  ?></div>
                <div class="sheet__value"><?= $option ?></div>
            </div>
        <?php } ?>
    </div>
</div>
