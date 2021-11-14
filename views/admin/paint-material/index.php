<?= $this->render('/admin/partials/_only_name_index',
    [
        'model' => $model,
        'base_url' => '/admin/paint-material',
        'title' => Yii::t('admin/paint-materials', 'title'),

        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel,
    ]
) ?>