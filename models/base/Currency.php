<?php

namespace app\models\base;

use Yii;

class Currency
{
    const CURRENCIES = ['ru', 'en', 'eur'];
    const CURRENCY_SYMBOL = ['₽', '$', '€'];
    const CURRENCY_PROP = ['ru'=>'price', 'en'=> 'price_usd', 'eur' => 'price_eur'];


    public static function getDefaultCurrency()
    {
        if (Yii::$app->language == 'ru-RU')
            return Currency::CURRENCIES[0];
        else if (Yii::$app->language == 'en-EN')
            return Currency::CURRENCIES[1];
        return Currency::CURRENCIES[2];

    }

    public static function getCurrenciesList()
    {
        return array_combine(self::CURRENCIES, self::CURRENCY_SYMBOL);
    }

    public static function getPriceStr($price, $currency){
        return Yii::t('app/orders', 'price_'.$currency, $price);
    }

    public static function getPriceStrings($model){

        $prices = array_map(function ($currency) use ($model) {
            return Currency::getPriceStr(Currency::getLocalPrice($model, $currency), $currency);
        }, Currency::CURRENCIES);

        return array_combine(Currency::CURRENCIES, $prices);
    }

    public static function getLocalPrice($model, $currency = null)
    {
        if(!$currency)
            $currency = Currency::getDefaultCurrency();

        $prop = Currency::CURRENCY_PROP[$currency];
        return $model->$prop;
    }
}