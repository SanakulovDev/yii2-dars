<?php

namespace frontend\controllers;
use common\models\City;
use yii\web\Controller;
class AjaxController extends Controller
{
    public function actionCity($id)
    {
        $cities = City::find()->where(['regionId'=> $id])->all();
        $data ='';
        foreach ($cities as  $item)
        {
            $data .= "<option value={$item->id}>{$item->nameUz}</option>";
        }
        return $data;
    }
}