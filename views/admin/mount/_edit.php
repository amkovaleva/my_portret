<?php

use app\models\base\Colour;
use app\models\base\Frame;
use app\models\base\Mount;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

?>

<?= $form->field($model, 'frame_id')
    ->dropDownList(ArrayHelper::map(Frame::find()->asArray()->all(), 'id', 'name'),
        array('prompt' => Yii::t('admin/base', 'empty_list'), 'change_url' => Url::to(["/admin/mount/change"]))); ?>

<?= $form->field($model, 'colour_id')->dropDownList(ArrayHelper::map(Colour::find()->asArray()->all(), 'id', 'name'),
    array('prompt' => Yii::t('admin/base', 'empty_list'))); ?>

<?= $form->field($model, 'portrait_format_id')
    ->dropDownList(
        ArrayHelper::map(Mount::getPossiblePortraitFormats($model->frame_id), 'id', 'name'),
        array('prompt' => Yii::t('admin/base', 'empty_list'))
    ); ?>

<h6>Изображение должно быть вертикальной ориентации!</h6>
<?= $form->field($model, 'image')->fileInput() ?>
<div class="form-group">
    <img src="<?= $model->imageUrl; ?>" alt="<?= Yii::t('admin/mounts', 'image') ?>">
</div>