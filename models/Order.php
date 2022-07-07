<?php

namespace app\models;


use Yii;
use yii\db\ActiveRecord;

class Order extends ActiveRecord
{

    const CREATED_STATE = 1;
    const APPROVED_STATE = 2;
    const CANCELED_STATE = 0;
    const IN_PROGRESS_STATE = 3;
    const FINISHED_STATE = 4;
    const IN_THE_WAY_STATE = 5;
    const DELIVERED_STATE = 6;

    public static function tableName()
    {
        return '{{orders}}';
    }

    public function rules()
    {
        return [
            [['state', 'first_name', 'last_name', 'email', 'index', 'country', 'city', 'street', 'house',  'apartment', 'cart_item_id'], 'required', 'message' => Yii::t('app/carts', 'required_message')],
            [['phone', 'middle_name', 'first_name', 'last_name', 'email', 'phone', 'index', 'country', 'city', 'street',   'house',  'apartment'], 'string'],
            [['created_at'], 'datetime'],
            [['state'], 'number'],
        ];
    }

    public function attributeLabels()
    {
        $lan_dir = 'app/carts';
        return [
            'id' => Yii::t($lan_dir, 'id'),
            'state' => Yii::t($lan_dir, 'state'),
            'first_name' => Yii::t($lan_dir, 'first_name'),
            'last_name' => Yii::t($lan_dir, 'last_name'),
            'middle_name' => Yii::t($lan_dir, 'middle_name'),
            'email' => Yii::t($lan_dir, 'email'),
            'phone' => Yii::t($lan_dir, 'phone'),
            'index' => Yii::t($lan_dir, 'index'),
            'country' => Yii::t($lan_dir, 'country'),
            'city' => Yii::t($lan_dir, 'city'),
            'street' => Yii::t($lan_dir, 'street'),
            'house' => Yii::t($lan_dir, 'house'),
            'apartment' => Yii::t($lan_dir, 'apartment'),
            'created_at' => Yii::t($lan_dir, 'created_at'),
        ];
    }


    public function fillDefault()
    {
        $this->state = Order::CREATED_STATE;
        $cart = CartItem::getCartItemsForUser();
        if($cart)
            $this->cart_item_id = $cart->id;
    }

    public function getCartItem()
    {
        return $this->hasOne(CartItem::class, ['id' => 'cart_item_id']);
    }

}