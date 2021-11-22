<?php

namespace app\models\base;

use Yii;
use yii\db\ActiveRecord;

class Format extends ActiveRecord
{
    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return '{{formats}}';
    }

    public function rules()
    {
        return [
            [['name', 'length', 'width'], 'required'],
            ['name', 'unique'],
            [['length', 'width'], 'unique', 'targetAttribute' => ['length', 'width']],
            [['length', 'width'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        $lan_dir = 'admin/formats';
        return [
            'id' => Yii::t($lan_dir, 'id'),
            'name' => Yii::t($lan_dir, 'name'),
            'length' => Yii::t($lan_dir, 'length'),
            'width' => Yii::t($lan_dir, 'width'),
        ];
    }

    public function getPrices()
    {
        return $this->hasMany(Price::class, ['format_id' => 'id']);
    }

}