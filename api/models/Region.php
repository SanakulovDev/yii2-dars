<?php

namespace api\models;

class Region extends \common\models\Region
{
    public function fields()
    {
        return [
            'nameUz',
            'nameRu'
        ];
    }
}