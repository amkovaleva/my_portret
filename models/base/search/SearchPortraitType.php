<?php

namespace app\models\base\search;

use app\models\base\PortraitType;

class SearchPortraitType extends PortraitType
{
    public function rules()
    {
        return [
            [['id','name'], 'safe'],
        ];
    }

    public function search($params)
    {
        return SearchHelper::searchName($params, SearchPortraitType::class, $this);
    }
}