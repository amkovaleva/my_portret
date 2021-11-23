<?= $this->render('/admin/partials/_index', [
    'model' => $model,
    'model_name' => 'mount',
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'columns' => [
        [
            'attribute' => 'colour_name',
            'value' => 'colour_name',
        ],
        [
            'attribute' => 'portrait_format_name',
            'value' => 'portrait_format_name',
        ],
        [
            'attribute' => 'frame_format_name',
            'value' => 'frame_format_name',
        ],
        'add_width',
        'add_length'
    ]
]) ?>
