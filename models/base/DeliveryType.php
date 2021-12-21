<?php

namespace app\models\base;

use Yii;

class DeliveryType extends BaseTranslation
{
    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return '{{delivery_types}}';
    }

    public function rules()
    {
        return [
            [['name', 'name_en',  'for_ru', 'for_not_ru'], 'required'],
            [['name', 'name_en',], 'string'],
            [['for_ru', 'for_not_ru'], 'boolean'],
            ['name', 'unique'],
            ['name_en', 'unique'],
        ];
    }

    public function attributeLabels()
    {
        $lan_dir = 'admin/delivery-types';
        return [
            'id' => Yii::t($lan_dir, 'id'),
            'name' => Yii::t($lan_dir, 'name'),
            'name_en' => Yii::t($lan_dir, 'name_en'),
            'for_ru' => Yii::t($lan_dir, 'for_ru'),
            'for_not_ru' => Yii::t($lan_dir, 'for_not_ru'),
        ];
    }

}