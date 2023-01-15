
<?php use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$input_options = ['options' => ['class' => 'form__field input'], 'labelOptions' => ['class' => 'input__label']];
$input_style = ['placeholder' => Yii::t('app/carts', 'placeholder'), 'class' => 'input__widget'];

$form = ActiveForm::begin(); ?>
<?= $form->field($model, 'server')->hiddenInput()->label(false) ?>

<div class="basket__data form">
    <h2 class="form__heading">
        <?= Yii::t('app/carts', 'account_title') ?>
    </h2>
    <div class="form__fieldset">

        <?= $form->field($model, 'cart_item_id')->hiddenInput()->label(false) ?>
        <?= $form->field($model, 'first_name', $input_options)->textInput($input_style) ?>
        <?= $form->field($model, 'middle_name', $input_options)->textInput($input_style) ?>
        <?= $form->field($model, 'last_name', $input_options)->textInput($input_style) ?>
        <?= $form->field($model, 'email', $input_options)->textInput( array_merge($input_style, ['type' => "email"])) ?>
        <?= $form->field($model, 'phone', $input_options)->textInput( array_merge($input_style, ['type' => "tel"])) ?>

    </div>
</div>
<div class="basket__data form">
    <h2 class="form__heading">
        <?= Yii::t('app/carts', 'address_title') ?>
    </h2>
    <div class="form__fieldset">

        <?= $form->field($model, 'country', $input_options)->textInput($input_style) ?>
        <?= $form->field($model, 'city', $input_options)->textInput($input_style) ?>
        <?= $form->field($model, 'street', $input_options)->textInput($input_style) ?>
        <?= $form->field($model, 'house', $input_options)->textInput($input_style) ?>
        <?= $form->field($model, 'apartment', $input_options)->textInput($input_style) ?>
        <?= $form->field($model, 'index', $input_options)->textInput($input_style) ?>

    </div>
</div>
<div class="basket__brief total">
    <div class="total__heading">
        <?= Yii::t('app/carts', 'total_price') ?>
    </div>
    <div class="total__price">
       <?=$model->cartItem->priceStr ?>
    </div>
    <div class="total__agreement">
        <?= Yii::t('app/carts', 'total_agreement') ?>
    </div>
</div>
<div class="basket__cart-submit">
    <?= Html::submitButton(Yii::t('app/carts', 'submit'), ['class' => 'button']) ?>
</div>

<?php ActiveForm::end(); ?>