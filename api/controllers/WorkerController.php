<?php

namespace api\controllers;


class WorkerController extends \yii\rest\ActiveController
{
    public $modelClass = "api\models\Worker";

    public function actions()
    {
        $actions = parent::actions();
        return $actions;
    }
    public function behaviors()
    {
        return [
            'corsFilter' => [
                'class' => \yii\filters\Cors::class,
            ],
        ];
    }

}