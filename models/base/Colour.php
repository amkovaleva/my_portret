<?php

namespace app\models\base;

use Yii;
use yii\helpers\ArrayHelper;

class Colour extends BaseTranslation
{
    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return '{{colours}}';
    }

    public function rules()
    {
        return [
            [['name', 'name_en', 'code'], 'required'],
            ['name', 'unique'],
            ['name_en', 'unique'],
            ['code', 'unique']
        ];
    }

    public function attributeLabels()
    {
        $lan_dir = 'admin/colours';
        return [
            'id' => Yii::t($lan_dir, 'id'),
            'name' => Yii::t($lan_dir, 'name'),
            'name_en' => Yii::t($lan_dir, 'name_en'),
            'code' => Yii::t($lan_dir, 'code'),
        ];
    }

    public static function prepareListForView($list, $id = 'id'){
        return ArrayHelper::map($list, $id, function ($model) {
            return [$model->colour->code, $model->colour->transName];
        });
    }
}