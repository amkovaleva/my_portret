<?php

namespace app\models\base;

use Intervention\Image\ImageManagerStatic as Image;
use Yii;
use yii\db\ActiveRecord;

class BaseImage extends ActiveRecord
{
    public $image;
    const UPLOAD_FOLDER = 'uploads/';


    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if ($insert || isset($changedAttributes['imageFile'])) {
            $fileInfo = explode('.', $this->imageFile);
            $fileInfo[0] = $this->imgName;
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

    public function getImageUrl()
    {
        if (!$this->imageFile)
            return '';
        return Yii::$app->request->baseUrl . '/' . (static::UPLOAD_FOLDER) . $this->imageFile;
    }


    public function clearImage()
    {
        array_map('unlink', glob(Yii::$app->basePath . '/web/' . static::UPLOAD_FOLDER . $this->imgName . '.*'));
    }

    public function saveImage($uploadedImage)
    {
        $imgRes = $uploadedImage->saveAs(static::UPLOAD_FOLDER . $this->imageFile);
        if (!$imgRes)
            return;

        $image = Image::make(Yii::getAlias('@web_dir') . '/' . static::UPLOAD_FOLDER . $this->imageFile);
        $image->orientate();
        if ($image->width() > $image->height()) {
            $image->rotate(-90);
            $image->save();
        }
    }
}