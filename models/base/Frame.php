<?php

namespace app\models\base;

use Yii;

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
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg', 'maxSize' => 1024 * 1024 * 15], //15 Mb
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

    public function getImgName(){
        return $this->getIsNewRecord() ? '0' : $this->id;
    }

}