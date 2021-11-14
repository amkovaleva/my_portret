<?php

namespace app\models\base\search;

use app\models\base\Colour;
use app\models\base\Frame;
use yii\data\ActiveDataProvider;

class SearchFrame extends Frame
{
    public $colour_name;
    public $format_name;

    public function rules()
    {
        return [
            [['colour_name', 'format_name', 'width'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = SearchFrame::find()->joinWith(['colour', 'format pf'])->select(Frame::tableName().'.*')
            ->addSelect([
                'colour_name' => Colour::tableName() . '.name',
                'format_name' => 'pf.name',
            ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'width',
                    'colour_name' => [
                        'asc' => ['colour_name' => SORT_ASC],
                        'desc' => ['colour_name' => SORT_DESC],
                    ],
                    'format_name' => [
                        'asc' => ['portrait_format_name' => SORT_ASC],
                        'desc' => ['portrait_format_name' => SORT_DESC],
                    ],
                ],
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }


        if ($this->width)
            $query->andWhere([Frame::tableName().'.width' => $this->width]);

        if ($this->colour_name)
            $query->andFilterWhere(['like', Colour::tableName() . '.name', $this->colour_name]);

        if ($this->format_name)
            $query->andFilterWhere(['like',  'pf.name', $this->format_name]);

        return $dataProvider;
    }
}