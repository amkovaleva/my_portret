<?php

namespace app\models\base\search;

use app\models\base\BackgroundMaterial;
use app\models\base\Format;
use app\models\base\PaintMaterial;
use app\models\base\PortraitType;
use app\models\base\Price;
use yii\data\ActiveDataProvider;

class SearchPrice extends Price
{
    public $format_name;
    public $bg_material_name;
    public $paint_material_name;
    public $portrait_type_name;

    public function rules()
    {
        return [
            [['format_name', 'bg_material_name', 'paint_material_name', 'portrait_type_name', 'price', 'price_usd', 'price_eur'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = SearchPrice::find()->joinWith(['format', 'portraitType', 'paintMaterial', 'backgroundMaterial'])
            ->select(Price::tableName().'.*')
            ->addSelect([
                'bg_material_name' => BackgroundMaterial::tableName() . '.name',
                'paint_material_name' => PaintMaterial::tableName() . '.name',
                'portrait_type_name' => PortraitType::tableName() . '.name',
                'format_name' => Format::tableName() . '.name',
            ]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'price', 'price_usd', 'price_eur',

                    'bg_material_name' => [
                        'asc' => ['bg_material_name' => SORT_ASC],
                        'desc' => ['bg_material_name' => SORT_DESC],
                    ],
                    'paint_material_name' => [
                        'asc' => ['paint_material_name' => SORT_ASC],
                        'desc' => ['paint_material_name' => SORT_DESC],
                    ],
                    'portrait_type_name' => [
                        'asc' => ['portrait_type_name' => SORT_ASC],
                        'desc' => ['portrait_type_name' => SORT_DESC],
                    ],
                    'format_name' => [
                        'asc' => ['format_name' => SORT_ASC],
                        'desc' => ['format_name' => SORT_DESC],
                    ],
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

        if ($this->bg_material_name)
            $query->andFilterWhere(['like', BackgroundMaterial::tableName() . '.name', $this->bg_material_name]);

        if ($this->paint_material_name)
            $query->andFilterWhere(['like', PaintMaterial::tableName() . '.name', $this->paint_material_name]);

        if ($this->portrait_type_name)
            $query->andFilterWhere(['like', PortraitType::tableName() . '.name', $this->portrait_type_name]);

        if ($this->format_name)
            $query->andFilterWhere(['like', Format::tableName() . '.name', $this->format_name]);


        return $dataProvider;
    }
}