<?= $this->render('/admin/partials/_index', [
    'model' => $model,
    'model_name' => 'cancel-reason',
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'columns' => ['name','description', 'description_en']
]) ?>
