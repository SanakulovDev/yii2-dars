<?php

use frontend\models\LaborActivity;
use frontend\models\WorkerLanguage;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $worker frontend\models\Worker */
/* @var $worker frontend\models\WorkerLanguage $modelsWorkerLAnguage */

$this->title = Yii::t('app', 'Update Lang: {name}', [
'name' => $worker->firstname,
]);
?>

<?= $this->render('worker-form', [
    'worker' => $worker,
    'modelsLaborActivity' => $modelsLaborActivity,
    'modelsWorkerLanguage' => $modelsWorkerLanguage
]) ?>