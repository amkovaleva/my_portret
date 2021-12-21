<?php

namespace app\models\base\search;

use app\models\base\DeliveryType;

class SearchDeliveryType extends DeliveryType
{
    public function rules()
    {
        return [
            [['name'], 'safe'],
        ];
    }

    public function search($params)
    {

        return SearchHelper::searchName($params, SearchDeliveryType::class, $this);
    }
}