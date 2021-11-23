<?php

namespace app\models\base\search;

use app\models\base\CountFace;
use yii\data\ActiveDataProvider;

class SearchCountFace extends CountFace
{

    public function rules()
    {
        return [
            [['min', 'max', 'coefficient'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = SearchCountFace::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'min', 'max', 'coefficient'
                ],
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }


        if ($this->min)
            $query->andWhere(['min' => $this->min]);

        if ($this->max)
            $query->andWhere(['min' => $this->max]);

        if ($this->coefficient)
            $query->andWhere(['coefficient' => $this->coefficient]);


        return $dataProvider;
    }
}