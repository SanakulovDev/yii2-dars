<?php

namespace api\models;

class Worker extends \frontend\models\Worker
{
    public function fields()
    {
        return [
            'firstname',
            'lastname'
        ];
    }
}