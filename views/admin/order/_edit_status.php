<div class="row bordered">
    <div class="col-md-6">
        <a href='<?= $model->fullPhotoUrl ?>'><img src='<?= $model->previewPhotoUrl ?>' class='photo_preview'></a>
    </div>
    <div class="col-md-6">
        <h1><?= Yii::t('admin/orders', 'edit_title') ?> №<?= $model->id ?></h1>
    </div>

</div>