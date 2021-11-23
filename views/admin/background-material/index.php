<?= $this->render('/admin/partials/_index', [
    'model' => $model,
    'model_name' => 'background-material',
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'columns' => ['name', 'is_mount:boolean']
]) ?>
