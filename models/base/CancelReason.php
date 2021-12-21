<?php

namespace app\models\base;

use Yii;

class CancelReason extends BaseTranslation
{
    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return '{{cancel_reasons}}';
    }

    public function rules()
    {
        return [
            [['name', 'description', 'description_en',], 'required'],
            [['name', 'name_en', 'description', 'description_en',], 'string'],
            ['name', 'unique'],
            ['name_en', 'unique'],
        ];
    }

    public function attributeLabels()
    {
        $lan_dir = 'admin/cancel-reasons';
        return [
            'id' => Yii::t($lan_dir, 'id'),
            'name' => Yii::t($lan_dir, 'name'),
            'description' => Yii::t($lan_dir, 'description'),
            'description_en' => Yii::t($lan_dir, 'description_en'),
        ];
    }

}