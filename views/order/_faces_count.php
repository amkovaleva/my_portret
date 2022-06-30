<?php
$list = $model->availableFacesCounts;
?>
<button class="select__handler" type="button">
    <span class="row">
        <span class="row__stat"><?= $list[$model->faces_count][0] ?></span>
        <span class="row__amount"><?= $list[$model->faces_count][1] ?></span>
    </span>
</button>
<div class="select__body">
    <?php foreach ($list as $key => $item) { ?>
        <button class="select__item <?= $key == $model->faces_count ? ' select__item--current' : '' ?>" type="button">
            <span class="row">
                <span class="row__stat"><?= $item[0] ?></span>
                <span class="row__amount"><?= $item[1] ?></span>
            </span>
        </button>
    <?php } ?>
</div>