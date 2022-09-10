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
        $query = SearchOrder::find()->joinWith(['cartItem', 'cartItem.portraitType pt', 'cartItem.format pf',
            'cartItem.backgroundMaterial bgM', 'cartItem.paintMaterial pM', 'cartItem.backgroundColour.colour bgC', 'cartItem.addons'])
            ->select(Order::tableName().'.*') -> addSelect(CartItem::tableName().'.*')
            ->addSelect([
                'background_colour_name' => 'bgC.name',
                'format_name' => 'pf.name',
                'portrait_type_name' => 'pt.name',
                'background_material_name' => 'bgM.name',
                'paint_material_name' => 'pM.name',
                'fio' => 'CONCAT( last_name, " ", first_name, " ", middle_name)',
                'price' => CartItem::tableName() . '.cost',
                'currency' => CartItem::tableName() . '.currency',
            ]);

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
            return $dataProvider;
        }

        if($this->portrait_base_info){

        }

        if($this->contact_info){

        }

        if($this->created_at){

        }

        if($this->state){

        }


        return $dataProvider;
    }
}