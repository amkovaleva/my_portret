<div class="waterfall">

    <?php

    use yii\helpers\Url;

    $list = [
        ['src' => '1.jpg', 'width' => 2000, 'height' => 2572, 'alt' => ''],
        ['src' => '2.jpg', 'width' => 2000, 'height' => 2734, 'alt' => ''],
        ['src' => '10.jpg', 'width' => 1500, 'height' => 2040, 'alt' => ''],
        ['src' => '3.jpg', 'width' => 1480, 'height' => 2000, 'alt' => ''],
        ['src' => '4.jpg', 'width' => 1402, 'height' => 2000, 'alt' => ''],
        ['src' => '5.jpg', 'width' => 1465, 'height' => 2000, 'alt' => ''],
        ['src' => '7.jpg', 'width' => 2000, 'height' => 1305, 'alt' => ''],
        ['src' => '8.jpg', 'width' => 2000, 'height' => 3000, 'alt' => ''],
        ['src' => '10.jpg', 'width' => 1500, 'height' => 2040, 'alt' => ''],
        ['src' => '4.jpg', 'width' => 1402, 'height' => 2000, 'alt' => ''],
        ['src' => '6.gif', 'width' => 800, 'height' => 1422, 'alt' => ''],
        ['src' => '1.jpg', 'width' => 2000, 'height' => 2572, 'alt' => ''],
        ['src' => '2.jpg', 'width' => 2000, 'height' => 2734, 'alt' => ''],
        ['src' => '10.jpg', 'width' => 1500, 'height' => 2040, 'alt' => ''],
        ['src' => '3.jpg', 'width' => 1480, 'height' => 2000, 'alt' => ''],
        ['src' => '4.jpg', 'width' => 1402, 'height' => 2000, 'alt' => ''],
    ];
    ?>

    <?php foreach ($list as $key => &$item) { ?>
        <div class="waterfall__item">
            <a class="waterfall__link" href="#">
                <img class="waterfall__image" src="/images/index/<?= $item['src'] ?>"
                     width="<?= $item['width'] ?>" height="<?= $item['height'] ?>" alt="<?= $item['alt'] ?>">
            </a>
        </div>
    <?php } ?>
</div>

<div class="order-section">
    <a class="order-section__submit button" href="<?=  Url::to(['/order-' .  Yii::$app->params['portrait_types'][$portrait_type_id]['key']])  ?>">
        <?= Yii::t( 'app/index', 'order') ?>
    </a>
</div>




