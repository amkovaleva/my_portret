<?php

namespace app\models;

use app\models\base\BaseTranslation;
use Yii;
use yii\db\ActiveRecord;

class Order extends ActiveRecord
{

    const CREATED_STATE = 1;
    const APPROVED_STATE = 2;
    const CANCELED_STATE = 0;
    const IN_PROGRESS_STATE = 3;
    const FINISHED_STATE = 4;
    const IN_THE_WAY_STATE = 5;
    const DELIVERED_STATE = 6;

    public static function tableName()
    {
        return '{{orders}}';
    }

    public function rules()
    {
        return [
            [['pay_type_id', 'delivery_type_id', 'language', 'state', 'user_cookie',
                'fio', 'email', 'index', 'country', 'region', 'address', ], 'required'],
            [['phone', 'fio', 'email', 'index', 'country', 'region', 'address',
                'language',  'track_info', 'user_comment', 'shop_comment', 'feedback'], 'string'],
            [['pay_type_id','delivery_type_id', 'cancel_reason_id',], 'integer'],
            [['created_at'], 'datetime'],
        ];
    }

    public function attributeLabels()
    {
        $lan_dir = 'admin/colours';
        return [
            'id' => Yii::t($lan_dir, 'id'),
            'name' => Yii::t($lan_dir, 'name'),
            'code' => Yii::t($lan_dir, 'code'),
        ];
    }


    public function fillDefault()
    {
        $this->state = Order::CREATED_STATE;
        $this->language = BaseTranslation::getDefaultLanguage();
        $this->user_cookie = Yii::$app->params['cookie_value'];
    }

}