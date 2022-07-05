<?php

use app\models\base\Currency;
?>

<div class="currency">
    <?php foreach (Currency::CURRENCIES as $key => &$item) { ?>
        <label class="currency__item">
            <input class="currency__widget" type="radio" value="<?= $item ?>"
                   name="CartItem[currency]" <?= $item == Currency::getDefaultCurrency() ? 'checked' : '' ?> >
            <span class="currency__label"><?= Currency::CURRENCY_SYMBOL[$key] ?></span>
        </label>
    <?php } ?>
</div>