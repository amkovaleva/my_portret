<?php

namespace app\models\base;

use Yii;
use yii\helpers\ArrayHelper;

class Frame extends BaseImage
{
    const UPLOAD_FOLDER = 'uploads/frames/';

    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return '{{frames}}';
    }

    public function rules()
    {
        return [
            [['colour_id', 'format_id', 'width', 'imageFile', 'name'], 'required'],
            [['width'], 'number'],
            [['name'], 'string'],
            [['name'], 'unique'],
            [['image'], 'file', 'extensions' => 'svg', 'maxSize' => 1024 * 1024 * 2], //2 Mb
        ];
    }

    public function attributeLabels()
    {
        $lan_dir = 'admin/frames';
        return [
            'id' => Yii::t($lan_dir, 'id'),
            'width' => Yii::t($lan_dir, 'width'),
            'colour_name' => Yii::t($lan_dir, 'colour'),
            'colour_id' => Yii::t($lan_dir, 'colour'),
            'format_id' => Yii::t($lan_dir, 'format'),
            'format_name' => Yii::t($lan_dir, 'format'),
            'image' => Yii::t($lan_dir, 'image'),
            'imageFile' => Yii::t($lan_dir, 'image'),
            'name' => Yii::t($lan_dir, 'name'),
        ];
    }

    public function getColour()
    {
        return $this->hasOne(Colour::class, ['id' => 'colour_id']);
    }

    public function getFormat()
    {
        return $this->hasOne(Format::class, ['id' => 'format_id']);
    }

    public function getMounts()
    {
        return $this->hasMany(Mount::class, ['frame_id' => 'id']);
    }

    public static function getList($portrait_format_id, $possible_mount, $for_ajax = false){
        $frames = Frame::find()->where(['format_id' => $portrait_format_id])->all();
        $res = [];
        if($for_ajax)
            foreach ($res as &$item)
                $res[] = ['id' => $item->id, 'name' => $item->name];
        else
            $res = ArrayHelper::map($frames, 'id', 'name');

        $frames_with_mount = [];
        if($possible_mount) {
            $list = Frame::find()->joinWith('mounts')->where(['portrait_format_id'=>$portrait_format_id])->all();
            if($for_ajax)
                foreach ($list as &$item)
                    $res[] = ['id' => $item->id, 'name' => $item->name];
            else
                $frames_with_mount = ArrayHelper::map($list, 'id', 'name');
        }
        return $res + $frames_with_mount;

    }
}