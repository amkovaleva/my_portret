<?php

namespace app\models;

use Yii;

class OrderConsts
{

    const PAINT_MATERIAL = 1;
    const BG_MATERIAL = 2;
    const FORMAT = 3;
    const FRAME_FORMAT = 4;
    const FACES = 5;
    const FRAME = 6;
    const MOUNT = 7;

    const FIELD_NAMES = [
        self::PAINT_MATERIAL => 'material_id',
        self::BG_MATERIAL => 'base_id',
        self::FORMAT => 'format_id',
        self::FACES => 'faces_count',
        self::FRAME_FORMAT => 'frame_format_id',
        self::FRAME => 'frame_id',
        self::MOUNT => 'mount_id',
    ];

    const FIELD_LOAD_NAMES = [
        self::PAINT_MATERIAL => 'availableMaterials',
        self::BG_MATERIAL => 'availableBases',
        self::FORMAT => 'availableFormats',
        self::FACES => 'availableFacesCounts',
        self::FRAME_FORMAT => 'availableFrameFormats',
        self::FRAME => 'availableFrames',
        self::MOUNT => 'availableMounts',
    ];

    const FIELD_CONTAINER = [
        self::PAINT_MATERIAL => '.materials__tools-choice',
        self::BG_MATERIAL => '.materials__surfaces-choice',
        self::FORMAT => '.order__portrait-size',
        self::FACES => '.order__people',
        self::FRAME_FORMAT => '.order__frame-size',
        self::FRAME => '.order__frame-color',
        self::MOUNT => '.order__mat',
    ];

    const FIELD_RENDER_PARAMS = [
        self::PAINT_MATERIAL => ['main_class' => 'tool', 'display' => 'button', 'field_name' => 'material_id'],
        self::BG_MATERIAL => ['main_class' => 'surface', 'display' => 'tab', 'field_name' => 'base_id'],
        self::FORMAT => [ 'class_name' => 'portrait-size', 'field_name' => 'format_id'],
        self::FACES => ['class_name' => 'people', 'field_name' => 'faces_count'],
        self::FRAME_FORMAT => ['class_name' => 'frame-size', 'field_name' => 'frame_format_id'],
        self::FRAME => ['class_name' => 'order__frame-color', 'field_name' => 'frame_id'],
        self::MOUNT => ['class_name' => 'order__mat', 'field_name' => 'mount_id'],
    ];

    const FIELD_RENDER_VIEWS = [
        self::PAINT_MATERIAL => '_material_widget',
        self::BG_MATERIAL => '_material_widget',
        self::FORMAT => '_select_widget',
        self::FACES => '_select_widget',
        self::FRAME_FORMAT => '_select_widget',
        self::FRAME => '_colour_picker_widget',
        self::MOUNT => '_colour_picker_widget',
    ];

    public static function getFieldPrompt($field)
    {
        $list =  [
            self::PAINT_MATERIAL => false,
            self::BG_MATERIAL => false,
            self::FORMAT => false,
            self::FACES => false,
            self::FRAME_FORMAT => Yii::t('app/orders', 'no_frame'),
            self::FRAME => false,
            self::MOUNT => false,
        ];
        return $list[$field];
    }

    public static function getFieldIndex($field_name)
    {
      foreach (self::FIELD_NAMES as $key => $value)
          if($field_name == $value)
              return $key;
      return 1;
    }
}