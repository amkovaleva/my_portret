<?php
$list = $model->availableFrameFormats;
$cur_value = $list[$model->frame_format_id]
?>
<button class="select__handler" type="button">
    <span class="row">
        <?=$cur_value ?>
    </span>
</button>
<div class="select__body">
    <?php foreach ($list as $key => $item) { ?>
        <button class="select__item <?= $key == $model->frame_format_id ? ' select__item--current' : '' ?>" type="button">
            <span class="row">
                <?=$key == 0 ? Yii::t('app/orders', 'without_frame') :  $item ?>
            </span>
        </button>
    <?php } ?>
</div>
