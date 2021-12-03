<?php

namespace api\models;

use yii\helpers\Url;
use yii\web\Link;

class Worker extends \frontend\models\Worker
{
    public function fields()
    {
        return [
            'id',
            'firstname',
            'lastname',
            'image' => function ($model) {
                return "http://anvar.smartdesign.uz/frontend/web/uploads/user/" . $model->photo;
            },
            'region' => function ($model) {
                if ($model->region) {
                    return [
                        'id' => $model->regionId,
                        'name' => $model->region->nameUz
                    ];

                }
                return null;
            },
            'profession' => function ($model) {
                if ($model->professions) {
                    return [
                        'id' => $model->profession_id,
                        'name' => $model->professions->name_uz
                    ];

                }
                return null;
            },
            'created_at'
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