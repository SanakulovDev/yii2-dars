<?php

namespace api\models;

class User extends \common\models\User
{
    public function fields()
    {
        return [
            'username',
            'password',
            'email' => 'my email'
        ];
    }
}