<?php

namespace app\models\base\search;

use app\models\base\Format;
use yii\data\ActiveDataProvider;

class SearchFormat extends Format
{
    public function rules()
    {
        return [
            [['id','name', 'length', 'width', 'max_faces'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = SearchFormat::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => ['name', 'id', 'length', 'width', 'max_faces'],
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if($this->name)
            $query->andFilterWhere(['like', 'name', $this->name]);

        if($this->id)
            $query->andWhere([ 'id' => $this->id]);

        if($this->length)
            $query->andWhere([ 'length' => $this->length]);

        if($this->width)
            $query->andWhere([ 'length' => $this->width]);

        if($this->max_faces)
            $query->andWhere([ 'max_faces' => $this->max_faces]);

        return $dataProvider;
    }
}