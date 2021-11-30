<?php

namespace app\models\base;

use Exception;
use Intervention\Image\ImageManagerStatic as Image;
use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

class BaseImage extends ActiveRecord
{
    public $image;
    const UPLOAD_FOLDER = 'uploads/';
    const PREVIEW_PREFIX = 'small_';

    public function getFullDir()
    {
        return Yii::getAlias('@web_dir') . '/' . static::UPLOAD_FOLDER;
    }

    public function getFullPath()
    {
        return Yii::$app->request->baseUrl . '/' . (static::UPLOAD_FOLDER);
    }

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
        return $this->fullPath . $this->imageFile;
    }

    public function getPreviewImageUrl()
    {
        if (!$this->imageFile)
            return '';
        return $this->fullPath. static::PREVIEW_PREFIX . $this->imageFile;
    }

    public function getImgName()
    {
        return $this->getIsNewRecord() ? '0' : $this->id;
    }

    public function clearImage()
    {
        $folder = $this->fullDir;
        array_map('unlink', glob($folder . $this->imgName . '.*'));
        array_map('unlink', glob($folder . static::PREVIEW_PREFIX . $this->imgName . '.*'));
    }

    public function saveWithImage($needPreview = false, $isVertical = true)
    {
        $image = UploadedFile::getInstance($this, 'image');
        if (isset($image))
            $this->imageFile = $this->imgName . '.' . $image->extension;

        $res = $this->save();

        if ($res && isset($image))
            $this->saveImage($image, $isVertical, $needPreview);

        return $res;
    }

    public function saveImage($uploadedImage, $isVertical, $needPreview)
    {
        $imgRes = $uploadedImage->saveAs(static::UPLOAD_FOLDER . $this->imageFile);

        if (!$imgRes)
            return;

        try {
            $image = Image::make($this->fullDir . $this->imageFile);
            $image->orientate();

            if ($isVertical && $image->width() > $image->height())
                $image->rotate(-90);

            $image->save();

        } catch (Exception $e) {
            var_dump($e);
        }

        if ($needPreview)
            $this->makePreviewImage();
    }

    public function makePreviewImage()
    {
        $folder = $this->fullDir;
        $image = Image::make($folder . $this->imageFile);
        $max_side = max([$image->width(), $image->height()]);
        $max_size_side = Yii::$app->params['max_side_preview_img'];
        if ($max_side > $max_size_side) {
            $scale = $max_size_side / $max_side;
            $image->resize($scale * $image->width(), $scale * $image->height());
        }
        $image->save($folder . static::PREVIEW_PREFIX . $this->imageFile);
    }
}