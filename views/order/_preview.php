<?php

use app\models\base\Currency;

?>

<div class="order__content">
    <div class="order__preview">
        <div class="stage stage--vertical">
            <div class="stage__inner">
                <img class="stage__portrait" src="/images/store/defaul-upload.jpg" width="1500" height="2141" alt="">
            </div>
            <!--<div class="stage__frame" style="background-image: url(frames/frame_30x40cm_black_white_mat.svg)"></div>-->
        </div>
    </div>
    <div class="order__footer">
        <div class="order__operations">
            <button class="order__option action action--clear" type="button"><?= Yii::t('app/orders', 'clear') ?></button>
            <button class="order__option action action--rotate" type="button"><?= Yii::t('app/orders', 'change_orientation') ?></button>
            <button class="order__option action action--move" type="button"><?= Yii::t('app/orders', 'change_area') ?></button>
        </div>
        <div class="order__total-price">

            <span><?= Currency::getPriceStr(array_sum(array_map(function ($price){
                return 1 * preg_replace("/[^0-9]/", "", $price);
                },$total)), Currency::getDefaultCurrency()) ?></span> <?= Yii::t('app/orders', 'total') ?>
        </div>
    </div>
    <div class="order__main-submit">
        <button class="button" type="button">
            <?= Yii::t('app/orders', 'add') ?>
        </button>
    </div>
</div>