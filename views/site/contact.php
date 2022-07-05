<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;

$lan_dir = 'app/contacts';
?>

<?php //if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
    <div class="shim">
        <div class="modal">
            <div class="modal__heading">Спасибо за ваше обращение!</div>
            <div class="modal__content">
                 Мы обязательно вам ответим.
            </div>
            <button class="modal__close button">Закрыть</button>
        </div>
    </div>
<?php //endif; ?>

<div class="contacts container">
    <div class="contacts__middle">
        <div class="contacts__content">
            <div class="contacts__slogan">
                <?= Yii::t($lan_dir, 'text') ?>
            </div>
            <div class="contacts__social media media--inlined">
                <a class="media__channel media__channel--instagram" href="#">Instagram</a>
                <a class="media__channel media__channel--youtube" href="#">Youtube</a>
                <a class="media__channel media__channel--facebook" href="#">Facebook</a>
            </div>
        </div>
        <div class="contacts__sidebar">
            <div class="contacts__form form">
                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <h1 class="form__heading">
                    <?= Yii::t($lan_dir, 'header') ?>
                </h1>

                <div class="form__fieldset">
                    <?php
                    $input_options = ['options' => ['class' => 'form__field input'], 'labelOptions' => ['class' => 'input__label']];
                    ?>

                    <?= $form->field($model, 'name', $input_options)
                        ->textInput(['placeholder' => Yii::t($lan_dir, 'name_placeholder'), 'class' => 'input__widget']) ?>

                    <?= $form->field($model, 'email', $input_options)
                        ->textInput(['placeholder' => Yii::t($lan_dir, 'email_placeholder'), 'class' => 'input__widget', 'type' => "email"]) ?>

                    <?= $form->field($model, 'phone', $input_options)
                        ->textInput(['placeholder' => Yii::t($lan_dir, 'phone_placeholder'), 'class' => 'input__widget', 'type' => "tel"]) ?>

                    <?php $input_options['options']['class'] .= ' input--area'; ?>
                    <?= $form->field($model, 'body', $input_options)
                        ->textarea(['placeholder' => Yii::t($lan_dir, 'body_placeholder'), 'class' => 'input__widget', 'rows' => 4]) ?>

                </div>
                <div class="form__footer">
                    <?= Html::submitButton(Yii::t($lan_dir, 'submit'), ['class' => 'button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
