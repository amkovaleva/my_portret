<?php

namespace app\models\base\search;

use app\models\base\BackgroundMaterial;

class SearchBackgroundMaterial extends BackgroundMaterial
{
    public function rules()
    {
        return [
            [['id','name'], 'safe'],
        ];
    }

    public function search($params)
    {
        return SearchHelper::searchName($params, SearchBackgroundMaterial::class, $this);
    }
}