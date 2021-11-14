<?php

namespace app\models\base;

use Yii;
use yii\db\ActiveRecord;

class PortraitType extends ActiveRecord
{
    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return '{{portrait_types}}';
    }

    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'unique']
        ];
    }

    public function attributeLabels()
    {
        $lan_dir = 'admin/portrait-types';
        return [
            'id' => Yii::t($lan_dir, 'id'),
            'name' => Yii::t($lan_dir, 'name')
        ];
    }

}