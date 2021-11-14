<?php

namespace app\models\base;

use Yii;
use yii\db\ActiveRecord;

class Colour extends ActiveRecord
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
            ['name', 'required'],
            ['name', 'unique']
        ];
    }

    public function attributeLabels()
    {
        $lan_dir = 'admin/formats';
        return [
            'id' => Yii::t($lan_dir, 'id'),
            'name' => Yii::t($lan_dir, 'name')
        ];
    }

}