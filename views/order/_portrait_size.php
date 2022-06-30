<?php
$list = $model->availableFormats;
?>
<button class="select__handler" type="button">
    <span class="row">
        <span class="row__stat"><?= $list[$model->format_id][0] ?> cm</span>
        <span class="row__amount"><?= $list[$model->format_id][1] ?></span>
    </span>
</button>
<div class="select__body">
    <?php foreach ($list as $key => $item) { ?>
        <button class="select__item <?= $key == $model->format_id ? ' select__item--current' : '' ?>" type="button">
            <span class="row">
                <span class="row__stat"><?= $item[0] ?> cm</span>
                <span class="row__amount"><?= $item[1] ?></span>
            </span>
        </button>
    <?php } ?>
</div>