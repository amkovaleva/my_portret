<?php

namespace app\models\base\search;

use app\models\base\Colour;
use app\models\base\Frame;
use app\models\base\Mount;
use yii\data\ActiveDataProvider;

class SearchMount extends Mount
{
    public $mount_colour;
    public $mount_portrait_format;
    public $frame_name;

    public function rules()
    {
        return [
            [['mount_colour', 'mount_portrait_format', 'frame_name'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = SearchMount::find()->joinWith(['frame f', 'portraitFormat pf', 'colour mc'])->select(SearchMount::tableName() . '.*')
            ->addSelect([
                'mount_colour' => 'mc.name',
                'mount_portrait_format' => 'pf.name',
                'frame_name' => 'f.name',
            ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'mount_colour' => [
                        'asc' => ['mount_colour' => SORT_ASC],
                        'desc' => ['mount_colour' => SORT_DESC],
                    ],
                    'mount_portrait_format' => [
                        'asc' => ['mount_portrait_format' => SORT_ASC],
                        'desc' => ['mount_portrait_format' => SORT_DESC],
                    ],
                    'frame_name' => [
                        'asc' => ['frame_name' => SORT_ASC],
                        'desc' => ['frame_name' => SORT_DESC],
                    ]
                ],
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }


        if ($this->mount_colour)
            $query->andFilterWhere(['like', 'mc.name', $this->mount_colour]);

        if ($this->mount_portrait_format)
            $query->andFilterWhere(['like', 'pf.name', $this->mount_portrait_format]);

        if ($this->frame_name)
            $query->andFilterWhere(['like', 'f.name', $this->frame_name]);


        return $dataProvider;
    }
}