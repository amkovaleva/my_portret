<?php

namespace app\models\base;

use Yii;
use yii\db\ActiveRecord;

class Price extends ActiveRecord
{
    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return '{{prices}}';
    }

    public function rules()
    {
        return [
            [['bg_material_id', 'paint_material_id', 'portrait_type_id', 'format_id', 'price', 'price_usd', 'price_eur'], 'required'],
            [['price', 'price_usd', 'price_eur'], 'number'],
            [['bg_material_id', 'paint_material_id', 'portrait_type_id', 'format_id'], 'unique',
                'targetAttribute' => ['bg_material_id', 'paint_material_id', 'portrait_type_id', 'format_id']],
        ];
    }

    public function attributeLabels()
    {
        $lan_dir = 'admin/prices';
        return [
            'id' => Yii::t($lan_dir, 'id'),
            'price' => Yii::t($lan_dir, 'price'),
            'price_usd' => Yii::t($lan_dir, 'price_usd'),
            'price_eur' => Yii::t($lan_dir, 'price_eur'),

            'bg_material_id' => Yii::t($lan_dir, 'bg_material'),
            'bg_material_name' => Yii::t($lan_dir, 'bg_material'),
            'paint_material_id' => Yii::t($lan_dir, 'paint_material'),
            'paint_material_name' => Yii::t($lan_dir, 'paint_material'),
            'portrait_type_id' => Yii::t($lan_dir, 'portrait_type'),
            'portrait_type_name' => Yii::t($lan_dir, 'portrait_type'),
            'format_id' => Yii::t($lan_dir, 'format'),
            'format_name' => Yii::t($lan_dir, 'format'),
        ];
    }

    public function getBackgroundMaterial()
    {
        return $this->hasOne(BackgroundMaterial::class, ['id' => 'bg_material_id']);
    }

    public function getPaintMaterial()
    {
        return $this->hasOne(PaintMaterial::class, ['id' => 'paint_material_id']);
    }

    public function getPortraitType()
    {
        return $this->hasOne(PortraitType::class, ['id' => 'portrait_type_id']);
    }

    public function getFormat()
    {
        return $this->hasOne(Format::class, ['id' => 'format_id']);
    }

    public function getLocalPrice()
    {
        if (Yii::$app->language == 'ru-RU')
            return $this->price;
        else if (Yii::$app->language == 'en-EN')
            return $this->price_usd;
        return $this->price_eur;
    }

}