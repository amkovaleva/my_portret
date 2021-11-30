<h1><?= $this->title ?></h1>

<?php foreach ($items as $key => &$item) {
    $p_options = [
        'format' => $item->format->sizesStr,
        'material' => Yii::t('app/orders', $item->paintMaterial->name),
        'base' => Yii::t('app/orders', $item->backgroundMaterial->name),
        'faces_count' => $item->faces_count,
        'background_color' => Yii::t('app/orders', $item->backgroundColour->colour->name),
    ];
    ?>
    <div>
        <h2><?= $key + 1 ?>. <?= Yii::t('app/orders', $item->portraitType->name) ?> </h2>
        <div>
            <h3><?= Yii::t('app/carts', 'portrait_info_title') ?></h3>
            <img src="<?= $item->previewImageUrl ?>" alt="<?= $key + 1 ?>. <?= Yii::t('app/carts', 'img_alt') ?>"/>

            <?php foreach ($p_options as $p_key => &$value) { ?>
                <div><?= Yii::t('app/orders', $p_key)?>: <?= $value ?></div>
            <?php } ?>
        </div>
        <?php if ($item->frame_id) {
            $f_options = [
                'frame_format' => $item->frame->format->sizesStr,
                'frame_colour' => Yii::t('app/orders', $item->frame->colour->name),
                'mount' => Yii::t('app/orders', $item->mount? $item->mount->colour->name : null),
            ];
            ?>
            <div>
                <h3><?= Yii::t('app/carts', 'frame_info_title') ?></h3>
                <img src="<? //= $item->frameImageUrl ?>"
                     alt="<?= $key + 1 ?>. <?= Yii::t('app/carts', 'frame_alt') ?>"/>
                <?php foreach ($f_options as $f_key => &$value) {
                    if(!$value)
                        continue;
                    ?>
                    <div><?= Yii::t('app/orders', $f_key)?>: <?= $value ?></div>
                <?php } ?>
            </div>
        <?php } ?>
        <div><?= Yii::t('app/orders', 'cost')?>: <?= $item->priceStr ?></div>
    </div>
<?php } ?>
