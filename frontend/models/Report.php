<?php

namespace frontend\models;

use yii\db\Query;

class Report extends \yii\base\Model
{
    public static function mapJoin()
    {
        $query = (new Query())
            ->select('')
            ->from('vacancy')
            ->innerJoin('company','vacancy.company_id','');
    }
}