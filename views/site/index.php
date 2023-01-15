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
            <?= Yii::t($lan_dir, 'about_me_title') ?>
        </h2>
        <div class="about__list">
            <?php
            $list = [
                ['count' => 3, 'class' => 'competitions'],
                ['count' => 47, 'class' => 'portraits'],
                ['count' => 15, 'class' => 'experience'],
                ['count' => 11, 'class' => 'publications'],
            ];
            ?>
            <?php foreach ($list as $key => &$item) { ?>
                <div class="about__feature about__feature--<?= $item['class'] ?>">
                    <b class="about__counter about__counter--spincrement" data-from="0" data-to="<?= $item['count'] ?>">
                        <?= $item['count'] ?>
                    </b>
                    <div class="about__stat">
                        <?= Yii::t($lan_dir, 'about_' . $item['class']) ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php
$list = [
    ['image' => '1.jpg', 'width' => 2000, 'height' => 2572, 'orig_width' => 2000, 'orig_height' => 2572, 'title' => ''],
    ['image' => '2.gif', 'width' => 2000, 'height' => 2734, 'orig_width' => 2000, 'orig_height' => 2734, 'title' => ''],
    ['image' => '3.jpg', 'width' => 1500, 'height' => 2040, 'orig_width' => 1500, 'orig_height' => 2040, 'title' => ''],
    ['image' => '4.jpg', 'width' => 1480, 'height' => 2000, 'orig_width' => 1480, 'orig_height' => 2000, 'title' => ''],
    ['image' => '5.jpg', 'width' => 1402, 'height' => 2000, 'orig_width' => 1402, 'orig_height' => 2000, 'title' => ''],
    ['image' => '6.jpg', 'width' => 1465, 'height' => 2000, 'orig_width' => 1465, 'orig_height' => 2000, 'title' => ''],
    ['image' => '7.jpg', 'width' => 2000, 'height' => 1305, 'orig_width' => 2000, 'orig_height' => 1305, 'title' => ''],
    ['image' => '8.jpg', 'width' => 2000, 'height' => 3000, 'orig_width' => 2000, 'orig_height' => 3000, 'title' => ''],
    ['image' => '9.jpg', 'width' => 1500, 'height' => 2040, 'orig_width' => 1500, 'orig_height' => 2040, 'title' => ''],
    ['image' => '10.jpg', 'width' => 1402, 'height' => 2000, 'orig_width' => 1402, 'orig_height' => 2000, 'title' => ''],
    ['image' => '11.jpg', 'width' => 800, 'height' => 2000, 'orig_width' => 800, 'orig_height' => 2000, 'title' => ''],
    ['image' => '12.jpg', 'width' => 2000, 'height' => 2572, 'orig_width' => 2000, 'orig_height' => 2572, 'title' => ''],
    ['image' => '13.jpg', 'width' => 2000, 'height' => 2734, 'orig_width' => 2000, 'orig_height' => 2734, 'title' => ''],
    ['image' => '14.jpg', 'width' => 1500, 'height' => 2040, 'orig_width' => 1500, 'orig_height' => 2040, 'title' => ''],
    ['image' => '15.jpg', 'width' => 1480, 'height' => 2000, 'orig_width' => 1480, 'orig_height' => 2000, 'title' => ''],
    ['image' => '16.jpg', 'width' => 1402, 'height' => 2000, 'orig_width' => 1402, 'orig_height' => 2000, 'title' => ''],
    ['image' => '17.jpg', 'width' => 1402, 'height' => 2000, 'orig_width' => 1402, 'orig_height' => 2000, 'title' => ''],
];
?>

<?= $this->render('_gallery_type', ['list' => $list, 'portrait_type_id' => null]) ?>

<div class="cinema">
    <div class="video video--22x9">
        <iframe class="video__widget" width="560" height="315" src="https://www.youtube.com/embed/jejuiyJBJYU"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
    </div>
</div>

