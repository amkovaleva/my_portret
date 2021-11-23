<?= $this->render('/admin/partials/_index', [
    'model' => $model,
    'model_name' => 'count-face',
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'columns' => ['min', 'max', 'coefficient']
]) ?>
