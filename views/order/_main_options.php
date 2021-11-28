<?php

use app\models\base\Price;
use app\models\OrderConsts;

?>

<?= $form->field($model, 'portrait_type_id')
    ->hiddenInput($model->availablePortraitTypes)->label(false) ?>


<?= $form->field($model, 'currency')->radioList(Price::getCurrenciesList(),
    [

        'item' => function ($index, $label, $name, $checked, $value) {

            $checked_str = $checked ? ' checked' : '';
            $return = '<label><input type="radio" name="' . $name . '" value="' . $value . '"' . $checked_str . '>' . $label . '</label>';

            return $return;
        },
        'changed-field' => OrderConsts::CURRENCY

    ]) ?>
<?= $form->field($model, 'material_id')->radioList($model->availableMaterials, [

    'item' => function ($index, $label, $name, $checked, $value) {

        $checked_str = $checked ? ' checked' : '';
        $return = '<label><input type="radio" name="' . $name . '" value="' . $value . '"' . $checked_str . '>' . $label . '</label>';

        return $return;
    },
    'changed-field' => OrderConsts::PAINT_MATERIAL

]) ?>
<?= $form->field($model, 'base_id')->radioList($model->availableBases, [

    'item' => function ($index, $label, $name, $checked, $value) {

        $checked_str = $checked ? ' checked' : '';
        $return = '<label><input type="radio" name="' . $name . '" value="' . $value . '"' . $checked_str . '>' . $label . '</label>';

        return $return;
    },
    'changed-field' => OrderConsts::BG_MATERIAL

]) ?>
<?= $form->field($model, 'format_id')->dropDownList($model->availableFormats,
    ['changed-field' => OrderConsts::FORMAT]) ?>
<?= $form->field($model, 'faces_count')->dropDownList($model->availableFacesCounts, ['changed-field' => OrderConsts::FACES]) ?>

<?= $form->field($model, 'background_color_id')->radioList($model->availableBgColours,
    [
        'item' => function ($index, $label, $name, $checked, $value) {

            $checked_str = $checked ? ' checked' : '';
            $return = '<label class="round" style="background: '
                . $label . '"><input type="radio" name="' . $name . '" value="' . $value . '"' . $checked_str . '></label>';

            return $return;
        }
    ]) ?>
<?= $form->field($model, 'cost')->textInput(['id' => 'cost', 'readonly' => true]) ?>
