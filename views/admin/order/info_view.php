
<div class="col-12">
    <?php use app\models\base\Currency;

    $is_coeff = !empty($faces_coeff);
    if(!$is_coeff) { ?>
        <?= Yii::t('admin/orders', 'no_coeff') ?>
    <?php } else{ ?>
        <?= Yii::t('admin/orders', 'coeff', $faces_coeff) ?>

    <?php }?>
    <hr/>
</div>
<?php if(empty($price)) { ?>
<div class="col">
    <?= Yii::t('admin/orders', 'no_price') ?>
</div>
<?php } else{
    foreach(Currency::CURRENCIES as $cur) {
        $cur_prop = Currency::CURRENCY_PROP[$cur];  ?>
    <div class="col-sm-12 col-md-4">
        <?= Yii::t('admin/orders', $is_coeff ? 'price_info_face' : 'price_info',
            [Currency::getPriceStr($price->$cur_prop, $cur),
            Currency::getPriceStr($price->$cur_prop * $faces_coeff, $cur)]) ?>
    </div>
<?php }
}?>
