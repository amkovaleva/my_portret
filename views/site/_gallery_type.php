<div class=" waterfall pswp-gallery" id="my-gallery-<?= $portrait_type_id ?>">

    <?php
    use yii\helpers\Url;
    use yii\web\View;

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
<?php if(isset($portrait_type_id) && !empty($portrait_type_id)){ ?>
    <div class="order-section">
        <a class="order-section__submit button"
           href="<?= Url::to(['/order-' . Yii::$app->params['portrait_types'][$portrait_type_id]['key']]) ?>">
            <?= Yii::t('app/index', 'order') ?>
        </a>
    </div>
<?php } ?>

<?php
$this->registerJs(<<<JS
const lightbox_$portrait_type_id = new PhotoSwipeLightbox({
  gallery: "#my-gallery-$portrait_type_id",
  children: "a.waterfall__link",
  pswpModule: () => PhotoSwipe
});

lightbox_$portrait_type_id.init();
JS
    ,
    View::POS_READY
);
?>
