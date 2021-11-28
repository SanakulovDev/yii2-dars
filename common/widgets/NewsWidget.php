<?php

namespace common\widgets;

use yii\helpers\Html;

class NewsWidget extends \yii\base\Widget
{

    public function init()
    {
        parent::init();
        if ($this->message === null) {
            $this->message = 'Hello World';
        }
    }

    public function run()
    {
        return Html::encode($this->message);
    }
}