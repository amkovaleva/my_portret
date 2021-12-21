<?php

namespace app\models\base;

use Yii;

class BackgroundMaterial extends BaseTranslation
{
    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return '{{bg_materials}}';
    }

    public function rules()
    {
        return [
            [['name', 'is_mount', 'name_en'], 'required'],
            ['name', 'unique'],
            ['name_en', 'unique'],
            ['is_mount', 'boolean']
        ];
    }

    public function attributeLabels()
    {
        $lan_dir = 'admin/background-materials';
        return [
            'id' => Yii::t($lan_dir, 'id'),
            'name' => Yii::t($lan_dir, 'name'),
            'name_en' => Yii::t($lan_dir, 'name_en'),
            'is_mount' => Yii::t($lan_dir, 'is_mount')
        ];
    }

    public function getPrices()
    {
        return $this->hasMany(Price::class, ['bg_material_id' => 'id']);
    }
}