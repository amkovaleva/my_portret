<?php

namespace app\models\base;

use Yii;
use yii\db\ActiveRecord;

class PaintMaterial extends ActiveRecord
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
            ['name', 'required'],
            ['name', 'unique']
        ];
    }

    public function attributeLabels()
    {
        $lan_dir = 'admin/paint-materials';
        return [
            'id' => Yii::t($lan_dir, 'id'),
            'name' => Yii::t($lan_dir, 'name')
        ];
    }

    public function getPrices()
    {
        return $this->hasMany(Price::class, ['paint_material_id' => 'id']);
    }
}