<?php

namespace frontend\models;

use yii\db\Query;

class Report extends \yii\base\Model
{
    public static function companyMapJoin($data)
    {
        $query = (new Query())
            ->select('count(*)')
            ->from('vacancy')
            ->where("vacancy.region_id = $data")
            ->innerJoin('company','vacancy.company_id = company.id')
            ->all();
        return $query;
    }
    public static function resumeMapJoin($data)
    {
        $query = (new Query())
            ->select('count(*)')
            ->from('vacancy')
            ->where("vacancy.region_id = $data")
            ->innerJoin('vacancy_orders','vacancy.id = vacancy_orders.vacancy_id')
            ->all();
        return $query;
    }
    public static function vacancyMapJoin($data)
    {
        $query = (new Query())
            ->select('count(*)')
            ->from('vacancy')
            ->where("vacancy.company_id = $data")
            ->all();
        return $query;
    }


}