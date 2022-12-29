<?php
use yii\helpers\Url;

$is_h1 = isset($is_h1) ? $is_h1 : false;
$h1_tag_name = $is_h1 ? "h1" : "a";
$href = !$is_h1 ? 'href="'.$url = Url::to('/').'"'  : '';
$logo_text = Yii::t('app/index', 'title');

?>
<!--[if IE]>
    <div class="browserupgrade"> <?=  Yii::t('app/index', 'ie_error') ?></div>
<![endif]-->

<?= sprintf('<%s %s class="logo">%s</%s >', $h1_tag_name, $href, $logo_text, $h1_tag_name)?>

<button class="burger" type="button"> <?=  Yii::t('app/index', 'menu') ?></button>

<div class="dropdown">
    <div class="dropdown__cell">
        <div class="nav">
            <a class="nav__link" href="<?= Url::to(['/site/gallery']) ?>"><?=  Yii::t('app/index', 'gallery') ?></a>
            <a class="nav__link" href="<?= Url::to(['/order/index']) ?>"><?=  Yii::t('app/index', 'store') ?></a>
            <a class="nav__link" href="<?= Url::to(['/site/contact']) ?>"><?=  Yii::t('app/index', 'contact') ?></a>
        </div>
        <div class="media">
            <?= $this->render('//partials/_socials') ?>
        </div>
        <!--<a class="cart-handler" href="#">
            0
        </a>-->
    </div>
</div>