<?php

namespace app\models;

use Yii;

class OrderConsts
{

    const PORTRAIT_TYPE = 0;
    const PAINT_MATERIAL = 1;
    const BG_MATERIAL = 2;
    const FORMAT = 3;
    const FRAME_FORMAT = 4;
    const FRAME = 5;
    const MOUNT = 6;

    const FIELD_NAMES = [
        self::PORTRAIT_TYPE => 'portrait_type_id',
        self::PAINT_MATERIAL => 'material_id',
        self::BG_MATERIAL => 'base_id',
        self::FORMAT => 'format_id',
        self::FRAME_FORMAT => 'frame_format_id',
        self::FRAME => 'frame_id',
        self::MOUNT => 'mount_id',
    ];

    const FIELD_LOAD_NAMES = [
        self::PORTRAIT_TYPE => 'availablePortraitTypes',
        self::PAINT_MATERIAL => 'availableMaterials',
        self::BG_MATERIAL => 'availableBases',
        self::FORMAT => 'availableFormats',
        self::FRAME_FORMAT => 'availableFrameFormats',
        self::FRAME => 'availableFrames',
        self::MOUNT => 'availableMounts',
    ];

    const FIELD_TYPES = [
        self::PORTRAIT_TYPE => 'select',
        self::PAINT_MATERIAL => 'select',
        self::BG_MATERIAL => 'select',
        self::FORMAT => 'radio',
        self::FRAME_FORMAT => 'select',
        self::FRAME => 'radio',
        self::MOUNT => 'radio',
    ];

    const FIELD_IS_COLOUR = [
        self::PORTRAIT_TYPE => false,
        self::PAINT_MATERIAL => false,
        self::BG_MATERIAL => false,
        self::FORMAT => false,
        self::FRAME_FORMAT => false,
        self::FRAME => true,
        self::MOUNT => true,
    ];


    public static function getFieldPrompt($field)
    {
        $list =  [
            self::PORTRAIT_TYPE => false,
            self::PAINT_MATERIAL => false,
            self::BG_MATERIAL => false,
            self::FORMAT => false,
            self::FRAME_FORMAT => Yii::t('app/orders', 'no_frame'),
            self::FRAME => false,
            self::MOUNT => false,
        ];
        return $list[$field];
    }
}