<?= $this->render('/admin/partials/_index', [
    'model' => $model,
    'model_name' => 'colour',
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'columns' => [ 'name',  'code']
]) ?>
