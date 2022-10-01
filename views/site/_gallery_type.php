<div class="waterfall">

    <?php
    use yii\helpers\Url;

    foreach ($list as $key => &$item) { ?>
        <div class="waterfall__item">
            <a class="waterfall__link" href="#">
                <img class="waterfall__image" src="/images/index/<?= $item['src'] ?>"
                     width="<?= $item['width'] ?>" height="<?= $item['height'] ?>" alt="<?= $item['alt'] ?>">
            </a>
        </div>
    <?php } ?>
</div>

<div class="order-section">
    <a class="order-section__submit button"
       href="<?= Url::to(['/order-' . Yii::$app->params['portrait_types'][$portrait_type_id]['key']]) ?>">
        <?= Yii::t('app/index', 'order') ?>
    </a>
</div>




