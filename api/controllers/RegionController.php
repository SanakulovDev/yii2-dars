<?php

namespace api\controllers;

use api\models\Region;
use api\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Response;

class RegionController extends \yii\rest\ActiveController
{
    public $modelClass = "api\models\Region";
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::class,
            'cors' => [
                'Origin' => ['*'],
            ],

        ];
        return $behaviors;
    }
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