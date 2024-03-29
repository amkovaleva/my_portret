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

    public static function getPricesInfo(){
        $prices = Price::find()->joinWith(['portraitType', 'paintMaterial', 'backgroundMaterial', 'format'])
            ->addSelect(Price::tableName(). '.*, ' . Format::tableName() . '.width')
            ->orderBy('portrait_type_id ASC, paint_material_id DESC, bg_material_id ASC, width ASC') ->all();
        $res = [];
        $pt = 0;
        $pm = 0;
        $bm = 0;
        foreach ($prices as &$item){
            if($pt != $item->portrait_type_id){
                $pt = $item->portrait_type_id;
                $pm = 0;
                $res[$pt] = [];
            }
            if($pm != $item->paint_material_id){
                $pm = $item->paint_material_id;
                $bm = 0;
                $res[$pt][$pm] = [];
            }
            if($bm != $item->bg_material_id){
                $bm = $item->bg_material_id;
                $res[$pt][$pm][$bm] = [];
            }
            $res[$pt][$pm][$bm][] = $item;
        }
        return $res;
    }

    public static function getPriceForCartItem($cartItem){
        return Price::find()->where([
            'portrait_type_id' => $cartItem->portrait_type_id,
            'paint_material_id' => $cartItem->material_id,
            'bg_material_id' => $cartItem->base_id,
            'format_id' => $cartItem->format_id,
        ])->one();
    }

}