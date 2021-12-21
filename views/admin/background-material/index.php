<?= $this->render('/admin/partials/_index', [
    'model' => $model,
    'model_name' => 'background-material',
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'columns' => ['name', 'name_en', 'is_mount:boolean']
]) ?>
