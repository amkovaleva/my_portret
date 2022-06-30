<?php

use yii\helpers\Url;

$lan_dir = 'app/index';
?>
<div class="jumbotron">
    <div class="jumbotron__cell">
        <div class="jumbotron__wrap container">
            <div class="jumbotron__stage">
                <div class="jumbotron__summary">
                    <div class="jumbotron__about">
                        <div class="jumbotron__tools"><?= Yii::t($lan_dir, 'oil_pencil') ?></div>
                        <div class="jumbotron__studio"><?= Yii::t($lan_dir, 'studio') ?></div>
                    </div>
                    <div class="jumbotron__slogan">
                        <?= Yii::t($lan_dir, 'save_moment') ?>
                    </div>
                </div>
            </div>
            <div class="jumbotron__footer">
                <a class="jumbotron__submit button" href="<?= Url::to(['/order/index']) ?>">
                    <?= Yii::t($lan_dir, 'order') ?>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="about">
    <div class="about__wrap container">
        <h2 class="about__heading dotted-title">
            about me.
        </h2>
        <div class="about__list">
            <?php
            $list = [
                ['count' => 1, 'class' => 'competitions'],
                ['count' => 40, 'class' => 'portraits'],
                ['count' => 14, 'class' => 'experience'],
                ['count' => 10, 'class' => 'publications'],
            ];
            ?>
            <?php foreach ($list as $key => &$item) { ?>
                <div class="about__feature about__feature--<?= $item['class'] ?>">
                    <b class="about__counter">
                        <?= $item['count'] ?>
                    </b>
                    <div class="about__stat">
                        <?= Yii::t($lan_dir, 'about_'.$item['class'])  ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<div class="waterfall">
    <?php
    $list = [
        ['src' => '1.jpg', 'width' => 2000, 'height' => 2572, 'alt' => ''],
        ['src' => '2.jpg', 'width' => 2000, 'height' => 2734, 'alt' => ''],
        ['src' => '3.jpg', 'width' => 1480, 'height' => 2000, 'alt' => ''],
        ['src' => '4.jpg', 'width' => 1402, 'height' => 2000, 'alt' => ''],
        ['src' => '5.jpg', 'width' => 1465, 'height' => 2000, 'alt' => ''],
        ['src' => '6.gif', 'width' => 800, 'height' => 1422, 'alt' => ''],
        ['src' => '7.jpg', 'width' => 2000, 'height' => 1305, 'alt' => ''],
        ['src' => '8.jpg', 'width' => 2000, 'height' => 3000, 'alt' => ''],
        ['src' => '9.jpg', 'width' => 3000, 'height' => 2000, 'alt' => ''],
        ['src' => '10.jpg', 'width' => 1500, 'height' => 2040, 'alt' => ''],
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
