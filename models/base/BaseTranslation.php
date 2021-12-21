<?php

namespace app\models\base;

use Yii;
use yii\db\ActiveRecord;

class BaseTranslation extends ActiveRecord
{

    const LANGUAGES = ['ru', 'en'];

    public function getTransName()
    {
        if(BaseTranslation::getDefaultLanguage() == BaseTranslation::LANGUAGES[0])
            return $this->name;
        return $this->name_en;
    }

    public function getTransDescription()
    {
        if(BaseTranslation::getDefaultLanguage() == BaseTranslation::LANGUAGES[0])
            return $this->description;
        return $this->description_en;
    }

    public static function getDefaultLanguage()
    {
        if (Yii::$app->language == 'ru-RU')
            return BaseTranslation::LANGUAGES[0];
        return BaseTranslation::LANGUAGES[1];
    }
}