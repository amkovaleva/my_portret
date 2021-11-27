<?= $this->render('/admin/partials/_index', [
    'model' => $model,
    'model_name' => 'format',
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'columns' => [ 'name', 'length', 'width', 'max_faces']
]) ?>