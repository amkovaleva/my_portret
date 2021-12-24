<?php
$p_options = [
    'format' => $item->format->sizesStr,
    'material' => $item->paintMaterial->transName,
    'base' =>  $item->backgroundMaterial->transName,
    'faces_count' => $item->faces_count,
    'background_color' =>  $item->backgroundColour->colour->transName,
];
?>
<div data-key="<?= $item->id ?>" class="cart-item">
    <h2><?= $key + 1 ?>. <?= Yii::t('app/orders', $item->portraitType->transName) ?></h2>
    <input type="button" value="<?= Yii::t('app/carts', 'delete') ?>">
    <div>
        <div>
            <h3><?= Yii::t('app/carts', 'portrait_info_title') ?></h3>
            <img src="<?= $item->previewImageUrl ?>" alt="<?= $key + 1 ?>. <?= Yii::t('app/carts', 'img_alt') ?>"/>
        </div>
        <div>
            <?php foreach ($p_options as $p_key => &$value) { ?>
                <div><?= Yii::t('app/orders', $p_key) ?>: <?= $value ?></div>
            <?php } ?>
        </div>
        <?php if ($item->frame_id) {
            $f_options = [
                'frame_format' => $item->frame->format->sizesStr,
                'frame_colour' =>  $item->frame->colour->transName,
                'mount' => $item->mount ? $item->mount->colour->transName : '',
            ];
            ?>
            <div>
                <h3><?= Yii::t('app/carts', 'frame_info_title') ?></h3>
                <img src="<?= $item->frameImageUrl ?>"
                     alt="<?= $key + 1 ?>. <?= Yii::t('app/carts', 'frame_alt') ?>"/>
            </div>
            <div>
                <?php foreach ($f_options as $f_key => &$value) {
                    if (!$value)
                        continue;
                    ?>
                    <div><?= Yii::t('app/orders', $f_key) ?>: <?= $value ?></div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
    <div><?= Yii::t('app/orders', 'cost') ?>: <?= $item->priceStr ?></div>
</div>