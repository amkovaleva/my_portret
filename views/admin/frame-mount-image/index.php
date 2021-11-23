<?= $this->render('/admin/partials/_index', [
    'model' => $model,
    'model_name' => 'frame-mount-image',
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'columns' => [
        [
            'attribute' => 'mount_colour',
            'value' => 'mount_colour',
        ],
        [
            'attribute' => 'mount_portrait_format',
            'value' => 'mount_portrait_format',
        ],
        [
            'attribute' => 'frame_name',
            'value' => 'frame_name',
        ],
        [
            'attribute' => 'imageFile',
            'format' => 'image',
            'value' => function ($data) {
                return $data->imageUrl;
            },
        ]
    ]
]) ?>
