<?php

use app\models\base\Addon;
use app\models\base\BackgroundColour;
use app\models\base\BackgroundMaterial;
use app\models\base\CountFace;
use app\models\base\Currency;
use app\models\base\Format;
use app\models\base\Frame;
use app\models\base\Mount;
use app\models\base\PaintMaterial;
use app\models\base\PortraitType;
use app\models\base\Price;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$change_url = Url::to(["/admin/cart-item/change", 'id' => $model->id]);
$model->addon_ids = array_keys(ArrayHelper::map($model->addons, 'id', 'name'));

$initial_frame_options = $model->getFrameInfo(true);
?>

<?php $form = ActiveForm::begin([
    'id' => 'edit-form',
    'method' => 'POST',
    'action' => Url::to(['/admin/cart-item/update', 'id' => $model->id]),
    'enableAjaxValidation' => true,
    'validationUrl' => Url::to(["/admin/cart-item/validate", 'id' => $model->id]),
    'options' => ['enctype' => 'multipart/form-data', 'class' => 'bordered']
]); ?>

<?= $form->field($model, 'id')->hiddenInput()->label(false) ?>
<?= $form->field($model, 'user_cookie')->hiddenInput()->label(false) ?>

<h2><?= Yii::t('admin/orders', 'edit_portrait-info') ?></h2>
<div class="row">
    <div class="col-sm-12 col-md-4">
        <?= $form->field($model, 'portrait_type_id')
            ->dropDownList(ArrayHelper::map(PortraitType::find()->asArray()->all(), 'id', 'name'), ['data-change-url' => $change_url]); ?>
    </div>
    <div class="col-sm-12 col-md-4">
        <?= $form->field($model, 'material_id')
            ->dropDownList(ArrayHelper::map(PaintMaterial::find()->asArray()->all(), 'id', 'name'), ['data-change-url' => $change_url]); ?>
    </div>
    <div class="col-sm-12 col-md-4">
        <?= $form->field($model, 'base_id')
            ->dropDownList(ArrayHelper::map(BackgroundMaterial::find()->asArray()->all(), 'id', 'name'), ['data-change-url' => $change_url]); ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-4">
        <?= $form->field($model, 'format_id')
            ->dropDownList(ArrayHelper::map(Format::find()->asArray()->all(), 'id', 'name'),
                ['data-change-url' => $change_url, 'change_url' => Url::to(["/admin/order/change-format"])]); ?>
    </div>
    <div class="col-sm-12 col-md-4">
        <?= $form->field($model, 'background_color_id')->dropDownList(BackgroundColour::getList()); ?>
    </div>
    <div class="col-sm-12 col-md-4">
        <?= $form->field($model, 'faces_count')->textInput(['type' => 'number', 'min' => 1, 'data-change-url' => $change_url]) ?>
    </div>
</div>
<hr/>

<div class="row">
    <div class="col-sm-12 col-md-6">
        <?= $form->field($model, 'frame_id')
            ->dropDownList(Frame::getList($model->format_id, $model->backgroundMaterial->is_mount),
                array('prompt' => Yii::t('admin/base', 'empty_list'), 'change_url' => Url::to(["/admin/order/change-frame"]))); ?>
    </div>
    <div class="col-sm-12 col-md-6">
        <?= $form->field($model, 'mount_id')
            ->dropDownList(Mount::getList($model->frame_id)); ?>
    </div>

</div>
<div class="alert alert-info">
    <div class="row">
        <div class="col">
            <h5><?= Yii::t('admin/orders', 'initial_frame_title') ?></h5>
        </div>
    </div>
    <div class="row">
        <?php foreach ($initial_frame_options as $key => $option) { ?>
            <div class="col-sm-6">
                <?= $key ?>
                <hr/>
            </div>
            <div class="col-sm-6">
                <?= $option ?>
                <hr/>
            </div>
        <?php } ?>
    </div>
</div>
<hr/>

<div id="info_container" class="alert alert-info">
    <?= $this->render('info_view', ['price' => Price::getPriceForCartItem($model),
        'faces_coeff' => CountFace::getCoefficient($model->faces_count)]) ?>
</div>
<hr/>

<div class="row">
    <div class="col-sm-12 col-md-6">
        <?= $form->field($model, 'cost')->textInput(['type' => 'number']) ?>
    </div>
    <div class="col-sm-12 col-md-6">
        <?= $form->field($model, 'currency')->dropDownList(Currency::getCurrenciesList()); ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <h6><?= Yii::t('admin/orders', 'addons_info') ?></h6>
    </div>
    <div class="col-sm-12">
        <?= $form->field($model, 'addon_ids')->checkboxList(Addon::getListForEditOrder())->label(false); ?>
    </div>
</div>

<div class="form-group">
    <?= Html::submitButton(Yii::t('admin/base', 'update'), ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>

