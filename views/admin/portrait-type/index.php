<?= $this->render('/admin/partials/_index', [
    'model' => $model,
    'model_name' => 'portrait-type',
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'columns' => [ 'name',  'name_en']
]) ?>