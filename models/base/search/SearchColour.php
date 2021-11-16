<?php

namespace app\models\base\search;

use app\models\base\Colour;
use yii\data\ActiveDataProvider;

class SearchColour extends Colour
{
    public function rules()
    {
        return [
            [['id','name','code'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Colour::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => ['name','code', 'id'],
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if($this->name)
            $query->andFilterWhere(['like', 'name', $this->name]);

        if($this->code)
            $query->andFilterWhere(['like', 'code', $this->code]);

        if($this->id)
            $query->andWhere([ 'id' => $this->id]);

        return $dataProvider;
    }
}