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
        $lang = ucfirst(Yii::$app->language);
        $name = 'name'.$lang;
        foreach ($cities as  $item)
        {
            $a = $item->name;
            $data .= "<option value={$item->id}>{}</option>";
        }
        return $data;
    }
}