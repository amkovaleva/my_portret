<?php

namespace app\models\base;

use Yii;

class Mount extends BaseImage
{
    const UPLOAD_FOLDER = 'uploads/mounts/';

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
            [['colour_id', 'portrait_format_id', 'frame_id', 'imageFile'], 'required'],
            [['colour_id', 'portrait_format_id', 'frame_id'], 'unique',
                'targetAttribute' => ['colour_id', 'portrait_format_id', 'frame_id']],
            [['image'], 'file', 'extensions' => 'svg', 'maxSize' => 1024 * 1024 * 2], //2 Mb
        ];
    }

    public function attributeLabels()
    {
        $lan_dir = 'admin/mounts';
        return [
            'id' => Yii::t($lan_dir, 'id'),
            'colour_id' => Yii::t($lan_dir, 'colour'),
            'mount_colour' => Yii::t($lan_dir, 'colour'),
            'portrait_format_id' => Yii::t($lan_dir, 'portrait_format'),
            'mount_portrait_format' => Yii::t($lan_dir, 'portrait_format'),
            'frame_id' => Yii::t($lan_dir, 'frame'),
            'frame_name' => Yii::t($lan_dir, 'frame'),
            'image' => Yii::t($lan_dir, 'image'),
            'imageFile' => Yii::t($lan_dir, 'image'),
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

    public function getFrame()
    {
        return $this->hasOne(Frame::class, ['id' => 'frame_id']);
    }

    public static function getPossiblePortraitFormats($frame_id)
    {
        $frame = Frame::find()
            ->joinWith('format', false, 'INNER JOIN')
            ->where([Frame::tableName() . '.id' => $frame_id])
            ->select(Format::tableName() .'.length as length, '.Format::tableName() .'.width as width')->asArray()->one();

        if (!$frame)
            return [];

        $list = Format::find()->where(['<', 'length', $frame['length']])->andWhere(['<', 'width', $frame['width']])->all();
        $res = [];
        foreach ($list as &$format) {
            $res[] = ['id' => $format->id, 'name' => $format->name];
        }
        return $res;
    }

    public static function getDefaultOrderObject($portrait_format_id)
    {
        return Mount::find()->joinWith('frame', false, 'INNER JOIN')
            ->joinWith('frame.colour fc', false, 'INNER JOIN')
            ->joinWith('colour mc', false, 'INNER JOIN')
            ->where(
                [
                    'portrait_format_id' => $portrait_format_id,
                    'fc.code' => '#000',
                    'mc.code' => '#fff',
                ]
            )
            ->select([Mount::tableName() . '.*', Frame::tableName() . '.format_id as frame_format_id'])->asArray()->one();
    }
}