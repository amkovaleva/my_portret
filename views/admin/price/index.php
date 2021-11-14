<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

?>

<h1><?= Yii::t('admin/prices', 'title') ?></h1>
<?php Pjax::begin(['id' => 'pjax', 'options' => ['neverTimeout' => true]]) ?>
<div class="row">
    <div id="form-container" class="col-12">
        <?= $this->render('edit', ['model' => $model]) ?>
    </div>
    <div class="col-12">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'bg_material_name',
                    'value' => 'bg_material_name',
                ],
                [
                    'attribute' => 'paint_material_name',
                    'value' => 'paint_material_name',
                ],
                [
                    'attribute' => 'portrait_type_name',
                    'value' => 'portrait_type_name',
                ],
                [
                    'attribute' => 'format_name',
                    'value' => 'format_name',
                ],
                'price', 'price_usd', 'price_eur',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{edit}{delete}',
                    'contentOptions' => ['class' => 'action-column'],
                    'buttons' => [
                        'delete' => function ($url, $model, $key) {
                            return Html::a('&#10008;', $url, [
                                'class' => 'delete-row'
                            ]);
                        },
                        'edit' => function ($url, $model, $key) {
                            return Html::a('&#9998;', $url, [
                                'class' => 'edit-row'
                            ]);
                        },
                    ],
                ],
            ],
        ]); ?>
    </div>

</div>
<?php Pjax::end() ?>

