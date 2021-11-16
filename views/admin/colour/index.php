<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;
?>

<h1><?=  Yii::t('admin/colours', 'title') ?></h1>

<?php Pjax::begin(['id' => 'pjax', 'options'=> ['neverTimeout'=>true]]) ?>
<div class="row">
    <div id="form-container" class="col-md-4">
        <?= $this->render('edit', ['model' => $model]) ?>
    </div>
    <div class="col-md-8">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'name',
                'code',
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

