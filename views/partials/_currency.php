<?php
use \app\models\base\Price;
?>

<div class="currency">
    <?php foreach (Price::CURRENCIES as $key => &$item) { ?>
        <label class="currency__item">
            <input class="currency__widget" type="radio" value="<?= $item ?>"
                   name="CartItem[currency]" <?= $item == Price::getDefaultCurrency() ? 'checked' : '' ?> >
            <span class="currency__label"><?= Price::CURRENCY_SYMBOL[$key] ?></span>
        </label>
    <?php } ?>
</div>