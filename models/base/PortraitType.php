<?php

namespace app\models\base;

use Yii;

class PortraitType extends BaseTranslation
{
    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return '{{portrait_types}}';
    }

    public function rules()
    {
        return [
            [['name', 'name_en'], 'required'],
            ['name', 'unique'],
            ['name_en', 'unique']
        ];
    }

    public function attributeLabels()
    {
        $lan_dir = 'admin/portrait-types';
        return [
            'id' => Yii::t($lan_dir, 'id'),
            'name' => Yii::t($lan_dir, 'name'),
            'name_en' => Yii::t($lan_dir, 'name_en')
        ];
    }


    public function getPrices()
    {
        return $this->hasMany(Price::class, ['portrait_type_id' => 'id']);
    }
}