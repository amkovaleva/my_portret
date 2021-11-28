<?php

namespace app\models\base;

use Yii;
use yii\db\ActiveRecord;

class CountFace extends ActiveRecord
{
    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return '{{count_faces}}';
    }

    public function rules()
    {
        return [
            [['min', 'max', 'coefficient'], 'required'],
            [['min', 'max', 'coefficient'], 'number'],
        ];
    }

    public function attributeLabels()
    {
        $lan_dir = 'admin/count-faces';
        return [
            'id' => Yii::t($lan_dir, 'id'),
            'min' => Yii::t($lan_dir, 'min'),
            'max' => Yii::t($lan_dir, 'max'),
            'coefficient' => Yii::t($lan_dir, 'coefficient'),
        ];
    }

    public static function getCoefficient($val)
    {
        return CountFace::find()->where('max >= ' . $val . ' and min <= ' . $val)->one()->coefficient;
    }
}