<?= $this->render('/admin/partials/_index', [
    'model' => $model,
    'model_name' => 'paint-material',
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'columns' => [ 'name',  'name_en']
]) ?>

