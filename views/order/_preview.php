
<div id="preview">
    <div id="upload-content">
        <?= $form->field($model, 'image')->fileInput()->label(false) ?>
        <div id="drop-zone">
            DROP HERE
        </div>
    </div>
    <div id="image-content" data-alt="<?= Yii::t('app/orders', 'img_alt')?>"></div>
</div>