<?= $this->render('/admin/partials/_only_name_index',
    [
        'model' => $model,
        'base_url' => '/admin/colour',
        'title' => Yii::t('admin/colours', 'title'),

        'dataProvider' => $dataProvider,
        'searchModel' => $searchModel,
    ]
) ?>
