<?php

namespace app\models\base;

use Yii;
use yii\db\ActiveRecord;

class BackgroundMaterial extends ActiveRecord
{
    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return '{{bg_materials}}';
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
        $lan_dir = 'admin/background-materials';
        return [
            'id' => Yii::t($lan_dir, 'id'),
            'name' => Yii::t($lan_dir, 'name')
        ];
    }

}