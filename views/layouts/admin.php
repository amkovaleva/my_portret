<?php

/* @var $this View */

/* @var $content string */

use app\assets\AdminAsset;
use app\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Url;
use yii\web\View;

AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' =>  Yii::t('admin/base', 'admin_title'),
        'brandUrl' => Url::to('/admin'),
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);
    $models = Yii::$app->params['admin_models'];
    $subMenus = array();

    foreach ($models as &$model_name){
        $dir = 'admin/'.$model_name . 's';
        $subMenus[] =  ['label' => Yii::t($dir, 'title'), 'url' => Url::to('/'.$dir)];
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [

            ['label' => Yii::t('admin/base', 'settings'), 'items' => $subMenus],
            Yii::$app->user->isGuest ? (
            ['label' => Yii::t('usuario', 'Login'), 'url' => ['/user/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/user/logout'], 'post')
                . Html::submitButton(
                    Yii::t('usuario', 'Logout') .' (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            ),
        ],
    ]);
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>

    <div id="modal-del-container" data-load-modal-url="<?= Url::to('/admin/admin/load-del-modal') ?>"></div>
</main>

<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage() ?>
