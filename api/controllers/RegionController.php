<?php

namespace api\controllers;

use api\models\Region;
use api\models\User;
use yii\data\ActiveDataProvider;

class RegionController extends \yii\rest\ActiveController
{
    public $modelClass = "api\models\Region";
//    public $result =[];
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
//        unset($actions['create']);
        return $actions;
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Region::find(),
//            'pagination' => [
//                'pageSize' => 2
//            ]
        ]);
        return $dataProvider;
    }
}