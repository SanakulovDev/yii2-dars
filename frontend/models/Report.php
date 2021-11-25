<?php

namespace frontend\models;

use yii\base\Model;
use \yii\db\Query;
use yii\helpers\ArrayHelper;

class Report extends Model
{
    public static function MapJoin($region = null)
    {

        $company = (new Query())
            ->select('region.id as region_id, count(company.regionId) as company')
            ->from('company')
            ->innerJoin('region', 'company.regionId = region.id')
            ->groupBy('region.id')
            ->all();

        $company_items = ArrayHelper::map($company, 'region_id', 'company');

        $vacancy = (new Query())
            ->select('region.id as region_id, count(vacancy.region_id) as vacancy')
            ->from('vacancy')
            ->innerJoin('region', 'vacancy.region_id = region.id')
            ->groupBy('region.id')
            ->all();

        $vacancy_items = ArrayHelper::map($vacancy, 'region_id', 'vacancy');

        $resume = (new Query())
            ->select('region.id as region_id, count(*) as resume')
            ->from('worker')
            ->innerJoin('region', 'region.id = worker.regionId')
            ->groupBy('region.id')
            ->all();

        $resume_items = ArrayHelper::map($resume, 'region_id', 'resume');

        $hc_keys = (new Query())
            ->select('id, hc_key')
            ->from('region')
            ->all();

        $result = [];

        foreach ($hc_keys as $region_id => $hc_key) {
            $result[] = [
                "hc-key" => $hc_key["hc_key"],
                "value" => $region_id,
                "resume_value" => isset($resume_items[$region_id]) ? $resume_items[$region_id] : 0,
                "company_value" => isset($company_items[$region_id]) ? $company_items[$region_id] : 0,
                "vacancy_value" => isset($vacancy_items[$region_id]) ? $vacancy_items[$region_id] : 0
            ];
        }

        return json_encode($result);

    }

    public static function vacancyChart()
    {


        $vacancy = (new Query())
            ->select('region.id as region_id, count(vacancy.region_id) as vacancy')
            ->from('vacancy')
            ->innerJoin('region', 'vacancy.region_id = region.id')
            ->groupBy('region.id')
            ->all();

        $vacancy_items = ArrayHelper::map($vacancy, 'region_id', 'vacancy');

        $region = (new Query())
            ->select('id, nameUz')
            ->from('region')
            ->all();

        foreach ($region as $item) {
            $series[] =
                [
                    'name' => $item['nameUz'],
                    'data' => [

                        [
                            $item['id'] , $vacancy_items[$item['id']],
                        ],

                    ]
                ];
        }
        return $series;
    }
    public static function resumeChart()
    {
        $resume = (new Query())
            ->select('region.id as region_id, count(*) as resume')
            ->from('worker')
            ->innerJoin('region', 'region.id = worker.regionId')
            ->groupBy('region.id')
            ->all();

        $resume_items = ArrayHelper::map($resume, 'region_id', 'resume');

        $region = (new Query())
            ->select('id, nameUz')
            ->from('region')
            ->all();

        foreach ($region as $item) {
            $series[] =
                [
                    'name' => $item['nameUz'],
                    'data' => [

                        [
                            $item['id'], $resume_items[$item['id']],
                        ],

                    ]
                ];
        }
        return $series;
    }
    public static function vacancyCount()
    {
        $count_vacancy = (new \yii\db\Query())
            ->select('count(*) as soni')
            ->from('vacancy')
            ->all();
        $region_list = (new Query())
            ->select('id, nameUz')
            ->from('region')
            ->all();
        $region_items = ArrayHelper::map($region_list,'id','nameUz');
        $result = [];
        $count = (new Query())
            ->select('count(*) as soni')
            ->from('vacancy')
            ->all();
        foreach ($region_items as $key => $item) {
            $vacancy = (new Query())
                ->select('count(*) as soni')
                ->from('vacancy')
                ->where("region_id = $key")
            ->all();
            $result[] = round($vacancy[0]['soni'] * 100 / $count[0]['soni'], 2);

        }
        return $result;
    }
}