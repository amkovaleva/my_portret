<?php
$trans_dir = 'app/carts';
$options = [
    'portrait_type_id' => $item->portraitType->transName,
    'material_id' => $item->paintMaterial->transName,
    'base_id' => $item->backgroundMaterial->transName,
    'format_id' => $item->format->sizesStr . ' cm',
    'background_color_id' => $item->backgroundColour->colour->transName,
    'faces_count' => $item->faces_count
];
if($item->frame){
    $options['frame_format_id'] = $item->frame->format->sizesStr . ' cm';
    $options['frame_id'] = $item->frame->colour->transName;

    if($item->mount){
        $options['mount_id'] = $item->mount->colour->transName;
    }
}
else
    $options['frame_format_id'] = Yii::t($trans_dir, 'no_frame');

$addons = $item->addons;
foreach ($addons as $addon) {
    $options[$addon->transName] = [\app\models\base\Currency::getPriceStr(\app\models\base\Currency::getLocalPrice($addon), $item->currency)];
}

$options['wrapping'] = Yii::t($trans_dir, 'included');
$options['delivery'] = Yii::t($trans_dir, 'included');

?>

<div class="basket__purchase cart">
    <h2 class="cart__heading title title--even-smaller">
        <?= $this->title ?>
    </h2>
    <div class="cart__summary sheet">

        <?php foreach ($options as $key => $option) {
            $is_addon = is_array($option);
            ?>
            <div class="sheet__row">
                <div class="sheet__param"><?= $is_addon ? $key : Yii::t($trans_dir, $key) ?></div>
                <div class="sheet__value"><?= $is_addon ? $option[0] : $option ?></div>
            </div>
        <?php } ?>
    </div>
</div>
