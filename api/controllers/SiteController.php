<?php

namespace api\controllers;

use api\models\LoginForm;

class SiteController extends \yii\rest\Controller
{
    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(\Yii::$app->request->post(), '') and ($token = $model->login())) {
            return ['token' => $token];
        }
        return $model;
    }
}