<?php

namespace frontend\models;

use yii\db\Query;

class Report extends \yii\base\Model
{
    public static function mapJoin($data)
    {
        $company = (new Query())
            ->select('count(*) as company')
            ->from('company')
            ->where("company.regionId = $data");

        $resume = (new Query())
            ->select('count(*) as resume')
            ->from('vacancy')
            ->where("region_id = $data")
            ->innerJoin('vacancy_orders','vacancy.id = vacancy_orders.vacancy_id');

        $vacancy = (new Query())
            ->select('count(*) as vacancy')
            ->from('vacancy')
            ->where("vacancy.region_id = $data");

        $resume= $resume->count();
        $company  = $company->count();
        $vacancy = $vacancy->count();
        $result = array($resume, $company, $vacancy);
        return $result;
    }



}