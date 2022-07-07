<?php

use app\models\base\Currency;

?>
<div class="order__addons">
    <div class="checklist">
        <div class="checklist__heading title title--smaller">
            <?= Yii::t('app/orders', 'addons') ?>
        </div>
        <div class="checklist__list">
            <?php foreach ($addons as $item) { ?>
                <label class="checklist__item choice choice--checkbox choice--full-width">
                    <input class="choice__widget" type="checkbox" name="CartItem[addon_ids][]" value="<?= $item->id ?>">
                    <i class="choice__icon"></i>
                    <span class="choice__label">
                        <?= $item->transName ?>
                        <?php
                        $priceStrings = Currency::getPriceStrings($item);
                        ?>
                        <span class="choice__price"  <?= $this->render('_currency_attributes', ['priceStrings' => $priceStrings]) ?>>
                            <?= $priceStrings[Currency::getDefaultCurrency()] ?>
                        </span>
                    </span>
                </label>
            <?php } ?>
        </div>
    </div>
</div>