<?php

namespace app\models\base\search;

use app\models\base\Colour;

class SearchColour extends Colour
{
    public function rules()
    {
        return [
            [['id','name'], 'safe'],
        ];
    }

    public function search($params)
    {
        return SearchHelper::searchName($params, SearchColour::class, $this);
    }
}