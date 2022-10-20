<div class="basket">
    <div class="basket__content">
        <div class="basket__preview">
            <div class="stage stage--vertical">
                <div class="stage__inner">
                    <img class="stage__portrait" src="<?= $item->imageUrl?>" alt="">
                </div>
                <div class="stage__frame" style="background-image: url(<?=$item->frame ? $item->frame->imageUrl : '' ?>)">
                </div>
            </div>
        </div>
    </div>
    <div class="basket__sidebar">
        <?= $this->render('_portrait_options', ['item' => $item]) ?>
        <?= $this->render('_order_options', ['model' => $model]) ?>
    </div>
</div>