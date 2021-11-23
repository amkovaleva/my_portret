<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

$columns = isset($columns) ? $columns : ['name'];
$grid_col_width = isset($grid_col_width) ? $grid_col_width : 4;

array_unshift($columns, ['class' => 'yii\grid\SerialColumn']);

array_push($columns, [
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
]);

?>

<h1><?= Yii::t('admin/' . $model_name . 's', 'title') ?></h1>
<?php Pjax::begin(['id' => 'pjax', 'options' => ['neverTimeout' => true]]) ?>
<div class="row">
    <div id="form-container" class="col-lg-<?=$grid_col_width ?>">
        <?= $this->render('/admin/'. $model_name .'/edit', ['model' => $model]) ?>
    </div>
    <div class="col-lg-<?=$grid_col_width < 12 ? 12 - $grid_col_width : 12 ?>">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => $columns
        ]); ?>
    </div>

</div>
<?php Pjax::end() ?>

