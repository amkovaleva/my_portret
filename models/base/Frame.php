<?php

namespace app\models\base;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class Frame extends ActiveRecord
{
    public $image;
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
            [['colour_id', 'format_id', 'width', 'imageFile'], 'required'],
            [['width'], 'integer'],
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg', 'maxSize' => 1024 * 1024 * 15], //15 Mb
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if ($insert || isset($changedAttributes['imageFile'])) {
            $fileInfo = explode('.', $this->imageFile);
            $fileInfo[0] = $this->id;
            $this->updateAttributes(['imageFile' => implode('.', $fileInfo)]);

            if (!$insert)
                $this->clearImage();
        }
    }

    public function afterDelete()
    {
        parent::afterDelete();
        $this->clearImage();
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

    public function getImageUrl()
    {
        if(!$this->imageFile)
            return '';
        return Yii::$app->request->baseUrl.'/'.Frame::UPLOAD_FOLDER . $this->imageFile;
    }

    public function clearImage()
    {
        array_map('unlink', glob(Yii::$app->basePath . '/web/' . Frame::UPLOAD_FOLDER . $this->id . '.*'));
    }
}