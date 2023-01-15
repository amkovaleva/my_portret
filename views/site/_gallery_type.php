<div class="waterfall">

    <?php

    use yii\helpers\Url;

    foreach ($list as &$item){
        $item['image'] = '/images/index/' . $item['image'];
        $item['thumb'] = str_replace(".","_thumb.", $item['image']);
    }
    ?>

    <?php foreach ($list as $key => &$item) { ?>
        <div class="waterfall__item">
            <a class="waterfall__link" href="<?= $item['image'] ?>"
               data-pswp-width="<?= $item['orig_width'] ?>"
               data-pswp-height="<?= $item['orig_height'] ?>"
               target="_blank"
            >
                <img class="waterfall__image" src="<?= $item['thumb'] ?>"
                     width="<?= $item['width'] ?>" height="<?= $item['height'] ?>" alt="<?= $item['title'] ?>">
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
