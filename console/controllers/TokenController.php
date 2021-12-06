<?php

namespace console\controllers;

use api\models\LoginForm;

class TokenController extends \yii\console\Controller
{
    public function actionCreate(){
        echo $this->token();
    }

    public function token(){
        echo "Username kiriting: ";
        $username = fread(STDIN, 80);
        echo "Password kiriting: ";
        $password = fread(STDIN, 80);
        $username = trim($username);
        $password = trim($password);

        $result = "Login yoki parolni mos kelmadi!\n";

        if (!empty($username) && !empty($password)){
            $model = new LoginForm();
            $model->username = $username;
            $model->password = $password;

            if ($token = $model->login()){
                $result =  $username .' useri uchun token: ' . $token . "\n";
            }
        }

        return $result;
    }
}