<?php

namespace app\models\base\search;

use app\models\base\BackgroundColour;
use app\models\base\Colour;
use yii\data\ActiveDataProvider;

class SearchBackgroundColour extends BackgroundColour
{
    public $colour_name;

    public function rules()
    {
        return [
            [['colour_name'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = SearchBackgroundColour::find()->joinWith(['colour'])->select(BackgroundColour::tableName().'.*')
            ->addSelect([
                'colour_name' => Colour::tableName() . '.name'
            ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'colour_name' => [
                        'asc' => ['colour_name' => SORT_ASC],
                        'desc' => ['colour_name' => SORT_DESC],
                    ]
                ],
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if ($this->colour_name)
            $query->andFilterWhere(['like', Colour::tableName() . '.name', $this->colour_name]);


        return $dataProvider;
    }
}