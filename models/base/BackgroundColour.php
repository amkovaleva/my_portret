<?php

namespace app\models\base;

use Yii;
use yii\db\ActiveRecord;

class BackgroundColour extends ActiveRecord
{
    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return '{{background_colors}}';
    }

    public function rules()
    {
        return [
            [['colour_id'], 'required'],
            ['colour_id', 'unique']
        ];
    }

    public function attributeLabels()
    {
        $lan_dir = 'admin/background-colours';
        return [
            'id' => Yii::t($lan_dir, 'id'),
            'colour_name' => Yii::t($lan_dir, 'colour'),
            'colour_id' => Yii::t($lan_dir, 'colour'),
        ];
    }

    public function getColour()
    {
        return $this->hasOne(Colour::class, ['id' => 'colour_id']);
    }

}