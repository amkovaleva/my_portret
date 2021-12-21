<?php

namespace app\models\base\search;

use app\models\base\CancelReason;

class SearchCancelReason extends CancelReason
{
    public function rules()
    {
        return [
            [['name'], 'safe'],
        ];
    }

    public function search($params)
    {

        return SearchHelper::searchName($params, SearchCancelReason::class, $this);
    }
}