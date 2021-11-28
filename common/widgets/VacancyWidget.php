<?php

namespace common\widgets;

use frontend\models\Vacancy;
use yii\base\Widget;
use yii\db\Query;
use yii\helpers\Html;

class VacancyWidget extends Widget
{
    public $count;

    public function init()
    {
        parent::init();
        if ($this->count === null) {
            $this->count = 5;
        }

    }

    public function run()
    {
        $vacancy = Vacancy::find()->orderBy('views DESC')->limit($this->count)->all();
        return $this->render('vacancy', [
            'vacancy' => $vacancy
        ]);
    }
}