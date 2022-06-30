<?php
use yii\bootstrap4\Html;
use app\assets\AppAsset;

AppAsset::register($this);
$this->beginPage();


?>
<!DOCTYPE html>
<html <?=  isset($this->params['html_class']) ? 'class="'.$this->params['html_class'].'"' : '' ?> lang="en_US">
    <head>
        <meta charset="utf-8">
        <title><?= Html::encode($this->title) ?></title>
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;500;600&display=swap" rel="stylesheet">
        <?php $this->head() ?>
        <?php $this->registerCsrfMetaTags() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <?= $this->render('//partials/_header', ['is_h1' =>  isset($this->params['is_h1_logo']) && $this->params['is_h1_logo']]) ?>
        <div class="page">
            <?= $content ?>
            <?= isset($this->params['need_footer']) && $this->params['need_footer'] ? $this->render('//partials/_footer') : '' ?>
        </div>

        <?php $this->endBody();?>
    </body>
</html>
<?php $this->endPage() ?>



