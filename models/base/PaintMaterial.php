<?php

namespace app\models\base;

use Yii;

class PaintMaterial extends BaseTranslation
{
    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return '{{paint_materials}}';
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
        $lan_dir = 'admin/paint-materials';
        return [
            'id' => Yii::t($lan_dir, 'id'),
            'name' => Yii::t($lan_dir, 'name'),
            'name_en' => Yii::t($lan_dir, 'name_en')
        ];
    }

    public function getPrices()
    {
        return $this->hasMany(Price::class, ['paint_material_id' => 'id']);
    }
}