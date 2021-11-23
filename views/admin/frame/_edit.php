<?php

use app\models\base\Colour;
use app\models\base\Format;
use yii\helpers\ArrayHelper;

?>


<?= $form->field($model, 'colour_id')->dropDownList(ArrayHelper::map(Colour::find()->asArray()->all(), 'id', 'name'),
    array('prompt' => Yii::t('admin/base', 'empty_list'))); ?>
<?= $form->field($model, 'format_id')->dropDownList(ArrayHelper::map(Format::find()->asArray()->all(), 'id', 'name'),
    array('prompt' => Yii::t('admin/base', 'empty_list'))); ?>
<?= $form->field($model, 'width')->textInput(['type' => 'number', 'step' => 0.01]) ?>
<?= $form->field($model, 'name') ?>

<?= $form->field($model, 'image')->fileInput() ?>
<div class="form-group">
    <img src="<?= $model->imageUrl; ?>" alt="<?= Yii::t('admin/frames', 'image')  ?>">
</div>