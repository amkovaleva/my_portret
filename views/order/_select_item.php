<span class="row">
    <?php
    if ($is_one_column) {
        echo $key ? $item : $empty_string;
    } else {
        $currency_data = isset($item[2]) ? $item[2] : [];
        ?>
        <span class="row__stat"><?= $item[0] ?></span>
        <span class="row__amount" <?= $this->render('_currency_attributes', ['priceStrings' => $currency_data]) ?> ><?= $item[1] ?></span>
    <?php } ?>
</span>