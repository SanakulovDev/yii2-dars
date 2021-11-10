<?php

namespace frontend\controllers;
use common\models\City;
use frontend\models\VacancyOrders;
use yii\web\Controller;
class AjaxController extends Controller
{
    public function actionCity($id)
    {
//        $cities = City::selectList($id);
        $cities = City::find()->where(['regionId'=> $id])->all();
        $lang = \Yii::$app->language;
        $name= 'name'.ucfirst($lang);
        foreach ($cities as  $item)
        {
            $data .= "<option value={$item->id}>{$item->$name}</option>";
        }
        return $data;
    }

    public function actionChangeStatus($id = null, $action = null)
    {
        $data = VacancyOrders::findOne([$id]);
        $data->status = $action;
        return $data;
    }
}