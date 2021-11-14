<?php

namespace app\models\base\search;

use app\models\base\Colour;
use app\models\base\Mount;
use yii\data\ActiveDataProvider;

class SearchMount extends Mount
{
    public $colour_name;
    public $portrait_format_name;
    public $frame_format_name;

    public function rules()
    {
        return [
            [['colour_name', 'portrait_format_name','frame_format_name', 'add_length', 'add_width'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = SearchMount::find()->joinWith(['colour', 'portraitFormat pf', 'frameFormat ff'])->select(Mount::tableName().'.*')
            ->addSelect([
                'colour_name' => Colour::tableName() . '.name',
                'portrait_format_name' => 'pf.name',
                'frame_format_name' => 'ff.name',
            ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'add_length', 'add_width',
                    'colour_name' => [
                        'asc' => ['colour_name' => SORT_ASC],
                        'desc' => ['colour_name' => SORT_DESC],
                    ],
                    'portrait_format_name' => [
                        'asc' => ['portrait_format_name' => SORT_ASC],
                        'desc' => ['portrait_format_name' => SORT_DESC],
                    ],
                    'frame_format_name' => [
                        'asc' => ['frame_format_name' => SORT_ASC],
                        'desc' => ['frame_format_name' => SORT_DESC],
                    ],
                ],
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if ($this->add_length)
            $query->andWhere(['add_length' => $this->add_length]);

        if ($this->add_width)
            $query->andWhere(['add_width' => $this->add_width]);

        if ($this->colour_name)
            $query->andFilterWhere(['like', Colour::tableName() . '.name', $this->colour_name]);

        if ($this->portrait_format_name)
            $query->andFilterWhere(['like',  'pf.name', $this->portrait_format_name]);

        if ($this->frame_format_name)
            $query->andFilterWhere(['like',  'ff.name', $this->frame_format_name]);

        return $dataProvider;
    }
}