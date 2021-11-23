<?= $this->render('/admin/partials/_index', [
    'model' => $model,
    'model_name' => 'price',
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'grid_col_width' => 12,
    'columns' => [
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
        'price', 'price_usd', 'price_eur'
    ]
]) ?>
