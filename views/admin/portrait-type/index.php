<?= $this->render('/admin/partials/_only_name_index',
    [
        'model' => $model,
        'base_url' => '/admin/portrait-type',
        'title' => Yii::t('admin/portrait-types', 'title'),

        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel,
    ]
) ?>