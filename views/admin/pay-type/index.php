<?= $this->render('/admin/partials/_index', [
    'model' => $model,
    'model_name' => 'pay-type',
    'dataProvider' => $dataProvider,
    'searchModel' => $searchModel,
    'columns' => ['name', 'name_en', 'description', 'description_en', 'for_ru:boolean', 'for_not_ru:boolean']
]) ?>
