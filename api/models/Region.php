<?php

namespace api\models;

use yii\helpers\Url;
use yii\web\Link;

class Region extends \common\models\Region
{
    public function fields()
    {
        return [
            'nameUz',
            'hc_key'
        ];
    }

    public function extraFields()
    {
        return [
            'nameEn',
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