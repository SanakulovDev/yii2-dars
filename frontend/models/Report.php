<?php

namespace frontend\models;

use yii\db\Query;

class Report extends \yii\base\Model
{
    public static function mapJoin($data)
    {
        $company = (new Query())
            ->select('count(*) as company')
            ->from('vacancy')
            ->where("vacancy.region_id = $data")
            ->innerJoin('company','vacancy.company_id = company.id')
            ->all();
        $resume = (new Query())
            ->select('count(*) as resume')
            ->from('vacancy')
            ->where("region_id = $data")
            ->innerJoin('vacancy_orders','vacancy.id = vacancy_orders.vacancy_id')
            ->all();
        $vacancy = (new Query())
            ->select('count(*) as vacancy')
            ->from('vacancy')
            ->where("vacancy.region_id = $data")
            ->all();
        $result = array($company, $resume, $vacancy);

        return $result;
    }



}