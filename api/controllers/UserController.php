<?php

namespace api\controllers;

use api\models\User;
use yii\data\ActiveDataProvider;

class UserController extends \yii\rest\ActiveController
{
    public $modelClass = "api\models\User";
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        return $actions;
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
//            'pagination' => [
//                'pageSize' => 2
//            ]
        ]);
        return $dataProvider;
    }
}