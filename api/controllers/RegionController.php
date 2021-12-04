<?php

namespace api\controllers;

use api\models\Region;

use yii\data\ActiveDataProvider;
use yii\web\Response;

class RegionController extends GeneralController
{
    public $modelClass = "api\models\Region";

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
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