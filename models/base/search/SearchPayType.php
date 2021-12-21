<?php

namespace app\models\base\search;

use app\models\base\PayType;

class SearchPayType extends PayType
{
    public function rules()
    {
        return [
            [['name'], 'safe'],
        ];
    }

    public function search($params)
    {

        return SearchHelper::searchName($params, SearchPayType::class, $this);
    }
}