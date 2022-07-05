<?php

namespace app\models\base\search;

use app\models\base\Addon;
use yii\data\ActiveDataProvider;

class SearchAddon extends Addon
{

    public function rules()
    {
        return [
            [['name', 'name_en', 'price', 'price_usd', 'price_eur'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = SearchAddon::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'price', 'price_usd', 'price_eur', 'name', 'name_en'
                ],
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if ($this->price)
            $query->andWhere(['price' => $this->price]);

        if ($this->price_usd)
            $query->andWhere(['price' => $this->price_usd]);

        if ($this->price_eur)
            $query->andWhere(['price' => $this->price_eur]);

        if ($this->price_eur)
            $query->andWhere(['price' => $this->price_eur]);

        if ($this->price_eur)
            $query->andWhere(['price' => $this->price_eur]);

        if ($this->name)
            $query->andFilterWhere(['like', 'name', $this->name]);

        if ($this->name_en)
            $query->andFilterWhere(['like', 'name_en', $this->name_en]);


        return $dataProvider;
    }
}