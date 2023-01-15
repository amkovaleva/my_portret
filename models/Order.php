<?php

namespace app\models;


use Yii;
use yii\db\ActiveRecord;

class Order extends ActiveRecord
{


    public static function tableName()
    {
        return '{{orders}}';
    }

    public function rules()
    {
        return [
            [['state', 'first_name', 'last_name', 'email', 'index',
                'country', 'city', 'street', 'house', 'apartment', 'cart_item_id', 'server'], 'required',
                'message' => Yii::t('app/carts', 'required_message')],
            [['middle_name', 'first_name', 'last_name', 'email', 'phone',
                'index', 'country', 'city', 'street', 'house', 'apartment',
                'shop_comment', 'shop_comment', 'user_comment', 'track_info'], 'string'],
            [['created_at'], 'date', 'format' => 'yyyy-M-d H:m:s'],
            [['state', 'cancel_reason_id'], 'number'],
            ['track_info', 'required', 'when' => function ($model) { return $model->state >= OrderConsts::IN_THE_WAY_STATE; }]
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
            'cancel_reason_id' => Yii::t($lan_dir, 'cancel_reason_id'),
            'shop_comment' => Yii::t($lan_dir, 'shop_comment'),
            'user_comment' => Yii::t($lan_dir, 'user_comment'),
            'track_info' => Yii::t($lan_dir, 'track_info'),
        ];
    }

    public function fillDefault()
    {
        $this->state = OrderConsts::CREATED_STATE;
        $this->server = $_SERVER['SERVER_NAME'];
        $cart = CartItem::getCartItemsForUser(false);
        if ($cart)
            $this->cart_item_id = $cart->id;
    }

    public function getCartItem()
    {
        return $this->hasOne(CartItem::class, ['id' => 'cart_item_id']);
    }

    public function getStateName()
    {
        return OrderConsts::stateNames()[$this->state];
    }

    public function getIsCanceled()
    {
        return OrderConsts::CANCELED_STATE === $this->state;
    }

    public function getPortraitOptions($is_admin = false)
    {
        $item = $this->cartItem;
        if (!$item)
            return [];

        $res = $item->getPortraitOptions($is_admin);

        if ($is_admin) {
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
        return $this->correctURLForServer($item->previewImageUrl);
    }

    public function getFullPhotoUrl()
    {
        $item = $this->cartItem;
        if (!$item)
            return '';
        return $this->correctURLForServer($item->imageUrl);
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
        if($this->track_info)
            $options[Yii::t($trans_dir, 'track_info')] = $this->track_info;
        if($this->shop_comment)
            $options[Yii::t($trans_dir, 'shop_comment')] = $this->shop_comment;
        if($this->user_comment)
            $options[Yii::t($trans_dir, 'user_comment')] = $this->user_comment;
        return $options;
    }

    private function correctURLForServer($url){
        return (!YII_ENV_DEV ? ('https://'. $this->server) : '') . $url;
    }
}