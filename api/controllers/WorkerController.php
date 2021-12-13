<?php

namespace api\controllers;

use api\models\Worker;
use yii\data\ActiveDataProvider;
use yii\rest\Controller;
use yii\web\Response;

class WorkerController extends Controller
{
//    public $modelClass = "api\models\Worker";

//    public function actions()
//    {
//        $actions = parent::actions();
//        unset($actions['index']);
//        return $actions;
//    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Worker::find(),
        ]);
        return $dataProvider;
    }

}