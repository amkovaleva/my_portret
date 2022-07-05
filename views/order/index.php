<?php

use app\models\base\Currency;
use yii\helpers\Url;

?>

<div class="store">
    <div class="store__currency">
        <?= $this->render('/partials/_currency') ?>
    </div>
    <div class="store__grid">
        <?php foreach ($prices as $portrait_type_id => &$portrait_type_info) {
            $key = Yii::$app->params['ids']['portrait_types'][$portrait_type_id];
            $type = mb_strtolower($portrait_type_info[1][1][0]->portraitType->transName);
            $paints = [];
            ?>
            <div class="store__tile">
                <a class="store__preview" href="<?= Url::to(['order/order-' . $key]) ?>">
                    <div class="store__content">
                        <img class="store__background" src="/images/store/store-background.jpg" width="630" height="525"
                             alt="">
                        <div class="store__fade"></div>
                        <div class="store__title"><?= $type ?>.</div>
                        <div class="store__overlay">
                            <div class="store__frame">
                                <div class="store__heading">
                                    <?= Yii::t('app/stores', $key . '_heading') ?>
                                    <i class="store__angle"></i>
                                    <i class="store__icon"></i>
                                </div>
                                <div class="store__params">
                                    <div class="store__row">
                                        <div class="store__label">
                                            <?= Yii::t('app/stores', 'detalisation') ?>
                                        </div>
                                        <div class="store__addition">
                                            <?php $i = 0;
                                            $starts = Yii::$app->params['portrait_types'][$key]['stars'];
                                            while ($i < $starts) { ?>
                                                <i class="store__star"></i>
                                                <?php $i++;
                                            } ?>
                                        </div>
                                    </div>
                                    <div class="store__row">
                                        <div class="store__label">
                                            <?= Yii::t('app/stores', 'est_time') ?>
                                        </div>
                                        <div class="store__addition">
                                            <?= Yii::t('app/stores', $key . '_time') ?>
                                        </div>
                                    </div>
                                </div>
                                <ul class="store__summary">
                                    <li class="store__list-item"><?= Yii::t('app/stores', $key . '_summary_1') ?></li>
                                    <li class="store__list-item"><?= Yii::t('app/stores', $key . '_summary_2') ?></li>
                                    <li class="store__list-item"><?= Yii::t('app/stores', $key . '_summary_3') ?></li>
                                </ul>
                                <div class="store__data">

                                    <?php foreach ($portrait_type_info as $paint_material_id => &$paint_material_info) {
                                        $paints[] = $paint_material_info[1][0]->paintMaterial->transName;
                                        foreach ($paint_material_info as $bg_material_id => &$bg_material_info) {
                                            $first = $bg_material_info[0];
                                            ?>
                                            <div class="store__column">
                                                <div class="store__sub-heading">
                                                    <?= $first->paintMaterial->transName ?>
                                                    / <?= $first->backgroundMaterial->transName ?>
                                                </div>
                                                <?php foreach ($bg_material_info as &$price) {
                                                    $priceStrings = Currency::getPriceStrings($price);
                                                    ?>
                                                    <div class="store__item">
                                                        <span class="store__stat"><?= $price->format->sizesStr ?>&nbsp;cm</span>
                                                        <span class="store__value"
                                                            <?= $this->render('_currency_attributes', ['priceStrings' => $priceStrings]) ?> >
                                                            <?= $priceStrings[$active_currency] ?>
                                                        </span>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        <?php }
                                    } ?>
                                </div>
                                <div class="store__submit">
                                    <div class="store__order"><?= Yii::t('app/stores', 'order') ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="store__footer">
                    <div class="store__sub-title"><?= $type ?></div>
                    <div class="store__note"><?= implode(' / ', $paints) ?></div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>