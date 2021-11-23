<?= $this->render('/admin/partials/_index', [
    'model' => $model,
    'model_name' => 'frame',
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'columns' => [
        'name',
        [
            'attribute' => 'colour_name',
            'value' => 'colour_name',
        ],
        [
            'attribute' => 'format_name',
            'value' => 'format_name',
        ],
        'width',
        [
            'attribute' => 'imageFile',
            'format' => 'image',
            'value' => function ($data) {
                return $data->imageUrl;
            },
        ]
    ]
]) ?>