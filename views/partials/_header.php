<?php
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => Yii::t('app/orders', 'title'), 'url' => ['order/index']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
            ['label' => 'About', 'url' => ['/site/about']],
        ],
    ]);
    NavBar::end();
    ?>
</header>