<?php

namespace frontend\controllers;

use common\models\City;
use common\models\JobType;
use common\models\Profession;
use common\models\Region;
use frontend\models\Company;
use frontend\models\VacancyOrders;
use Yii;
use yii\web\Controller;

class AjaxController extends Controller
{
    public function actionCity($id)
    {
//        $cities = City::selectList($id);
        $cities = City::find()->where(['regionId' => $id])->all();
        $lang = \Yii::$app->language;
        $name = 'name' . ucfirst($lang);
        $data = '';
        foreach ($cities as $item) {
            $data .= "<option value={$item->id}>{$item->$name}</option>";
        }
        return $data;
    }

//    action indexSearch
    public function actionIndexSearch()
    {
        $params = Yii::$app->request->queryParams;
        if (isset($params['q']) && strlen($params['q']) > 2) {
            $cities = City::find()->where(['like', 'nameUz', trim($params['q'])])->asArray()->all();
            $regions = Region::find()->where(['like', 'nameUz', trim($params['q'])])->asArray()->all();
            $companys = Company::find()->where(['like','name',trim($params['q'])])->asArray()->all();
            $job_types = JobType::find()->where(['like','name_uz',trim($params['q'])])->asArray()->all();
            $professions = Profession::find()->where(['like','name_uz',trim($params['q'])])->asArray()->all();
            $sections1 = array_merge($regions, $cities);
            $sections2 = array_merge($professions, $job_types);
            $results = [];
            if ($sections1) {
                foreach ($sections1 as $city) {
                    $results[] = [
                        'id' => $city['id'],
                        'text' => $city['nameUz']
                    ];
                }
            }
            if ($sections2) {
                foreach ($sections2 as $city) {
                    $results[] = [
                        'id' => $city['id'],
                        'text' => $city['name_uz']
                    ];
                }
            }
            if ($companys){
                foreach ($companys as $company) {
                    $results[]=[
                        'id'=>$company['id'],
                        'text'=>$company['name']
                    ];
                }
            }


            return json_encode(['results' => $results]);
        } else {
            return json_encode(['results' => []]);
        }

    }

    public function actionChangeStatus($id = null, $action = null)
    {
        $data = VacancyOrders::findOne([$id]);
        $data->status = $action;
        return $data;
    }
}