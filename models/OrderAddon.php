<?php

namespace app\models;


use app\models\base\Addon;
use Yii;
use yii\db\ActiveRecord;

class OrderAddon extends ActiveRecord
{


    public static function tableName()
    {
        return '{{order_addons}}';
    }

    public function rules()
    {
        return [
            [['cart_item_id', 'addon_id'], 'required', 'message' => Yii::t('app/carts', 'required_message')],
            [['cart_item_id', 'addon_id'], 'number'],
            [['cart_item_id', 'addon_id'], 'unique', 'targetAttribute' => ['cart_item_id', 'addon_id']],
        ];
    }

    public function getAddon()
    {
        return $this->hasOne(Addon::class, ['id' => 'addon_id']);
    }
}