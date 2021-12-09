<?php

namespace api\modules\v1\controllers;

use api\controllers\GeneralController;
use yii\data\ActiveDataProvider;

class ResumeController extends GeneralController
{
    public function actionIndex()
    {

        $model = new ActiveDataProvider([

        ]);

        return $model;
    }
}