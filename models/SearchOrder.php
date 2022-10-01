<?php

namespace app\models;
use yii\data\ActiveDataProvider;

class SearchOrder extends Order
{
    public $portrait_base_info;
    public $price;
    public $currency;
    public $contact_info;

    public function rules()
    {
        return [
            [['state', 'portrait_base_info', 'contact_info'], 'safe']
        ];
    }

    public function search($params)
    {
        $query = SearchOrder::find()->joinWith('cartItem', true, 'INNER JOIN')->joinWith(['cartItem.portraitType pt', 'cartItem.format pf',
            'cartItem.backgroundMaterial bgM', 'cartItem.paintMaterial pM', 'cartItem.backgroundColour.colour bgC']) ;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => ['state', 'created_at']
            ],
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            $this->state = Order::DEFAULT_STATES;
            $query->andFilterWhere(['in', 'state', Order::DEFAULT_STATES]);
            return $dataProvider;
        }

        if($this->state)
            $query->andFilterWhere(['in', 'state', $this->state]);

        if($this->contact_info){
            $str = mb_strtolower($this->contact_info);

            $query->andFilterWhere(
                ['or',
                    ['like', 'LOWER( first_name)', $str],
                    ['like', 'LOWER( last_name)', $str],
                    ['like', 'LOWER( middle_name)', $str],
                    ['like', 'LOWER( email)', $str],
                    ['like', 'LOWER( phone)', $str],
                    ['like', 'LOWER( index)', $str],
                    ['like', 'LOWER( country)', $str],
                    ['like', 'LOWER( city)', $str],
                    ['like', 'LOWER( street)', $str],
                    ['like', 'LOWER( house)', $str],
                    ['like', 'LOWER( apartment)', $str],

                ]);
        }

        if($this->portrait_base_info){
            $str = mb_strtolower($this->portrait_base_info);

            $query->andFilterWhere(
                ['or',
                    ['like', 'LOWER( pt.name)', $str],
                    ['like', 'LOWER( pf.name)', $str],
                    ['like', 'LOWER( bgM.name)', $str],
                    ['like', 'LOWER( pM.name)', $str]
                ]);
        }

        return $dataProvider;
    }
}