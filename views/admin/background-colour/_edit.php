<?php

use app\models\base\Colour;
use yii\helpers\ArrayHelper;

?>

<?= $form->field($model, 'colour_id')->dropDownList(ArrayHelper::map(Colour::find()->asArray()->all(), 'id', 'name'),
    array('prompt'=>Yii::t('admin/base', 'empty_list')) ); ?>
