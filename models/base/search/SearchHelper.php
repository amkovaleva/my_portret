<?php

namespace app\models\base\search;

use yii\data\ActiveDataProvider;

class SearchHelper
{

    public static function searchName($params, $class, $model){
        $query = $class::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => ['name', 'id'],
            ],
        ]);

        if (!($model->load($params) && $model->validate())) {
            return $dataProvider;
        }

        if($model->name)
            $query->andFilterWhere(['like', 'name', $model->name]);

        if($model->id)
            $query->andWhere([ 'id' => $model->id]);

        return $dataProvider;
    }

}