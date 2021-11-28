<?php

namespace app\models\base;

use Yii;

class FrameMountImage extends BaseImage
{
    const UPLOAD_FOLDER = 'uploads/mounts/';

    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return '{{frame_mount_images}}';
    }

    public function rules()
    {
        return [
            [['mount_id', 'frame_id', 'imageFile'], 'required'],
            [['mount_id', 'frame_id'], 'unique', 'targetAttribute' => ['mount_id', 'frame_id']],
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg', 'maxSize' => 1024 * 1024 * 15], //15 Mb
        ];
    }

    public function attributeLabels()
    {
        $lan_dir = 'admin/frame-mount-images';
        return [
            'id' => Yii::t($lan_dir, 'id'),
            'mount_id' => Yii::t($lan_dir, 'mount'),
            'mount' => Yii::t($lan_dir, 'mount'),
            'frame_id' => Yii::t($lan_dir, 'frame'),
            'frame' => Yii::t($lan_dir, 'frame'),
            'frame_name' => Yii::t($lan_dir, 'frame'),
            'image' => Yii::t($lan_dir, 'image'),
            'imageFile' => Yii::t($lan_dir, 'image'),
            'mount_colour' => Yii::t($lan_dir, 'mount_colour'),
            'mount_portrait_format' => Yii::t($lan_dir, 'mount_portrait_format'),
        ];
    }

    public function getMount()
    {
        return $this->hasOne(Mount::class, ['id' => 'mount_id']);
    }

    public function getFrame()
    {
        return $this->hasOne(Frame::class, ['id' => 'frame_id']);
    }

    public static function getMounts($frame_id)
    {
        $frame = Frame::findOne(['id' => $frame_id]);
        if (!$frame)
            return [];

        $list = Mount::find()->with(['colour', 'portraitFormat'])->where(['frame_format_id' => $frame->format_id])->all();
        $res = [];
        foreach ($list as &$mount) {
            $res[] = ['id' => $mount->id, 'name' => $mount->colour->name . Yii::t('admin/frame-mount-images', 'select_mid') . $mount->portraitFormat->name];
        }
        return $res;
    }

    public static function getDefaultOrderObject($portrait_format_id)
    {
        return FrameMountImage::find()->joinWith('frame', false, 'INNER JOIN')
            ->joinWith('mount m', false, 'INNER JOIN')
            ->joinWith('frame.colour fc', false, 'INNER JOIN')
            ->joinWith('mount.colour mc', false, 'INNER JOIN')
            ->where(
                [
                    'm.portrait_format_id' => $portrait_format_id,
                    'fc.code' => '#000',
                    'mc.code' => '#fff',
                ]
            )
            ->select([FrameMountImage::tableName(). '.*', Mount::tableName().'.frame_format_id as frame_format_id'])->asArray()->one();
    }

    public function getImgName()
    {
        return $this->frame_id . '_' . $this->mount_id;
    }
}