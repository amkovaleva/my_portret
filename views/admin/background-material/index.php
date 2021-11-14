<?= $this->render('/admin/partials/_only_name_index',
    [
        'model' => $model,
        'base_url' => '/admin/background-material',
        'title' => Yii::t('admin/background-materials', 'title'),

        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel,
    ]
) ?>