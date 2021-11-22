<?php

namespace app\models\base;

use Yii;
use yii\db\ActiveRecord;

class Mount extends ActiveRecord
{
    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return '{{mounts}}';
    }

    public function rules()
    {
        return [
            [['colour_id', 'portrait_format_id', 'frame_format_id', 'add_length', 'add_width'], 'required'],
            [['add_length', 'add_width'], 'number'],
            [['colour_id', 'portrait_format_id','frame_format_id'], 'unique',
                'targetAttribute' =>['colour_id', 'portrait_format_id', 'frame_format_id']],
        ];
    }

    public function attributeLabels()
    {
        $lan_dir = 'admin/mounts';
        return [
            'id' => Yii::t($lan_dir, 'id'),
            'add_length' => Yii::t($lan_dir, 'add_length'),
            'add_width' => Yii::t($lan_dir, 'add_width'),
            'colour_name' => Yii::t($lan_dir, 'colour'),
            'colour_id' => Yii::t($lan_dir, 'colour'),
            'format_name' => Yii::t($lan_dir, 'portrait_format'),
            'portrait_format_id' => Yii::t($lan_dir, 'portrait_format'),
            'portrait_format_name' => Yii::t($lan_dir, 'portrait_format'),
            'frame_format_id' => Yii::t($lan_dir, 'frame_format'),
            'frame_format_name' => Yii::t($lan_dir, 'frame_format'),
        ];
    }

    public function getColour()
    {
        return $this->hasOne(Colour::class, ['id' => 'colour_id']);
    }

    public function getPortraitFormat()
    {
        return $this->hasOne(Format::class, ['id' => 'portrait_format_id']);
    }

    public function getFrameFormat()
    {
        return $this->hasOne(Format::class, ['id' => 'frame_format_id']);
    }

    public function getInfo()
    {
        return $this->colour->name . " " . $this->portraitFormat->name;
    }
}