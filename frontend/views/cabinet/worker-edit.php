<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $worker frontend\models\Worker */

$this->title = Yii::t('app', 'Update Lang: {name}', [
'name' => $worker->firstname,
]);
?>

<?= $this->render('worker-form', [
    'worker' => $worker,
]) ?>