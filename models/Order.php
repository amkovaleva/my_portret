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

    const STATE_NAMES = [
        self::CREATED_STATE => 'Создан',
        self::APPROVED_STATE => "Одобрен",
        self::CANCELED_STATE => "Отменен",
        self::IN_PROGRESS_STATE => "В прогрессе",
        self::FINISHED_STATE => "Закончен",
        self::IN_THE_WAY_STATE => "В пути",
        self::DELIVERED_STATE => "Доставлен"
    ];
    const DEFAULT_STATES = [
        self::CREATED_STATE ,
        self::APPROVED_STATE,
        self::IN_PROGRESS_STATE,
        self::FINISHED_STATE,
        self::IN_THE_WAY_STATE
    ];

    public static function tableName()
    {
        return '{{orders}}';
    }

    public function rules()
    {
        return [
            [['state', 'first_name', 'last_name', 'email', 'index', 'country', 'city', 'street', 'house', 'apartment', 'cart_item_id'], 'required', 'message' => Yii::t('app/carts', 'required_message')],
            [['phone', 'middle_name', 'first_name', 'last_name', 'email', 'phone', 'index', 'country', 'city', 'street', 'house', 'apartment'], 'string'],
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

            'contact_info' => Yii::t($lan_dir, 'account_title'),
            'portrait_base_info' => Yii::t($lan_dir, 'portrait_title'),
            'total_price' => Yii::t($lan_dir, 'total_price'),
            'photo' => Yii::t($lan_dir, 'photo'),
        ];
    }

    public function fillDefault()
    {
        $this->state = Order::CREATED_STATE;
        $cart = CartItem::getCartItemsForUser();
        if ($cart)
            $this->cart_item_id = $cart->id;
    }

    public function getCartItem()
    {
        return $this->hasOne(CartItem::class, ['id' => 'cart_item_id']);
    }

    public function getStateName()
    {
        return Order::STATE_NAMES[$this->state];
    }

    public function getPortraitOptions($is_admin = false)
    {
        $item = $this->cartItem;
        if (!$item)
            return [];

        $res = $item->getPortraitOptions($is_admin);

        if($is_admin) {
            $res[] = null;
            $res[Yii::t('app/carts', 'total_price')] = $this->totalPrice;
        }

        return $res;
    }

    public function getFIO()
    {
        return implode(' ', [$this->last_name, $this->first_name, $this->middle_name]);
    }

    public function getPreviewPhotoUrl()
    {
        $item = $this->cartItem;
        if (!$item)
            return '';
        return $item->previewImageUrl;
    }

    public function getFullPhotoUrl()
    {
        $item = $this->cartItem;
        if (!$item)
            return '';
        return $item->imageUrl;
    }

    public function getTotalPrice()
    {
        $item = $this->cartItem;
        if (!$item)
            return '';
        return $item->priceStr;
    }

    public function getAddressString()
    {
        $lan_dir = 'app/carts';
        return sprintf("%s, %s, %s; %s: %s;  %s: %s;   %s: %s. ",
            $this->index, $this->country, $this->city,
            Yii::t($lan_dir, 'street'), $this->street,
            Yii::t($lan_dir, 'house'), $this->house,
            Yii::t($lan_dir, 'apartment'), $this->apartment);
    }

    public function getContactInfo()
    {
        $trans_dir = 'app/carts';

        $options = [
            Yii::t($trans_dir, 'first_name') => $this->fIO,
            Yii::t($trans_dir, 'email') => $this->email,
            Yii::t($trans_dir, 'phone') => $this->phone,
            Yii::t($trans_dir, 'address_title') => $this->addressString,
        ];
        return $options;
    }
}