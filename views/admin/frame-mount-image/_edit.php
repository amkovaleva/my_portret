<?php

use app\models\base\Frame;
use app\models\base\FrameMountImage;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

?>

<?= $form->field($model, 'frame_id')
    ->dropDownList(ArrayHelper::map(Frame::find()->asArray()->all(), 'id', 'name'),
    array('prompt' => Yii::t('admin/base', 'empty_list'), 'change_url' => Url::to(["/admin/frame-mount-image/change"]))); ?>
<?= $form->field($model, 'mount_id')->dropDownList( ArrayHelper::map(FrameMountImage::getMounts($model->frame_id), 'id', 'name'),
    array('prompt' => Yii::t('admin/base', 'empty_list'))); ?>

<?= $form->field($model, 'image')->fileInput() ?>
<div class="form-group">
    <img src="<?= $model->imageUrl; ?>" alt="<?= Yii::t('admin/frame-mount-images', 'image')  ?>">
</div>