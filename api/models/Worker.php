<?php

namespace api\models;

use yii\helpers\Url;
use yii\web\Link;

class Worker extends \frontend\models\Worker
{
    public function fields()
    {
        return [
            'firstname',
            'lastname'
        ];
    }

    public function extraFields()
    {
        return [
            'userId',
        ];
    }

    public function getLinks()
    {
        return [
            Link::REL_SELF => Url::to(['region/view', 'id' => $this->id], true),
            'edit' => Url::to(['region/view', 'id' => $this->id], true),
            'profile' => Url::to(['region/profile/view', 'id' => $this->id], true),
            'index' => Url::to(['regions'], true),
        ];
    }
}