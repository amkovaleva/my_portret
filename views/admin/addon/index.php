<?= $this->render('/admin/partials/_index', [
    'model' => $model,
    'model_name' => 'addon',
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'columns' => [ 'name',  'name_en',  'price',  'price_usd',  'price_eur']
]) ?>
