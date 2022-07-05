<?php

namespace app\models\base;

use Yii;
use yii\helpers\ArrayHelper;

class Addon extends BaseTranslation
{
    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return '{{addons}}';
    }

    public function rules()
    {
        return [
            [['name', 'name_en', 'price', 'price_usd', 'price_eur'], 'required'],
            ['name', 'unique'],
            ['name_en', 'unique'],
            [['price', 'price_usd', 'price_eur'], 'number'],
        ];
    }

    public function attributeLabels()
    {
        $lan_dir = 'admin/addons';
        return [
            'id' => Yii::t($lan_dir, 'id'),
            'name' => Yii::t($lan_dir, 'name'),
            'name_en' => Yii::t($lan_dir, 'name_en'),
            'price' => Yii::t($lan_dir, 'price'),
            'price_usd' => Yii::t($lan_dir, 'price_usd'),
            'price_eur' => Yii::t($lan_dir, 'price_eur'),
        ];
    }
}