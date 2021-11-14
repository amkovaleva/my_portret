<?php

namespace app\models\base\search;

use app\models\base\PaintMaterial;

class SearchPaintMaterial extends PaintMaterial
{
    public function rules()
    {
        return [
            [['id','name'], 'safe'],
        ];
    }

    public function search($params)
    {
        return SearchHelper::searchName($params, SearchPaintMaterial::class, $this);
    }
}