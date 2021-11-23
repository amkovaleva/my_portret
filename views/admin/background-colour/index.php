<?= $this->render('/admin/partials/_index', [
    'model' => $model,
    'model_name' => 'background-colour',
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'columns' => [
        [
            'attribute' => 'colour_name',
            'value' => 'colour_name',
        ]
    ]
]) ?>