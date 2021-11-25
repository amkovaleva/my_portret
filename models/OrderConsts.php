<?php

namespace app\models;

class OrderConsts
{

    const PORTRAIT_TYPE = 0;
    const PAINT_MATERIAL = 1;
    const BG_MATERIAL = 2;
    const FORMAT = 3;

    const FIELD_NAMES = [
        self::PORTRAIT_TYPE => 'portrait_type_id',
        self::PAINT_MATERIAL => 'material_id',
        self::BG_MATERIAL => 'base_id',
        self::FORMAT => 'format_id'
    ];
    const FIELD_LOAD_NAMES = [
        self::PORTRAIT_TYPE => 'availablePortraitTypes',
        self::PAINT_MATERIAL => 'availableMaterials',
        self::BG_MATERIAL => 'availableBases',
        self::FORMAT => 'availableFormats'
    ];
    const FIELD_TYPES = [
        self::PORTRAIT_TYPE => 'select',
        self::PAINT_MATERIAL => 'select',
        self::BG_MATERIAL => 'select',
        self::FORMAT => 'radio'
    ];
}