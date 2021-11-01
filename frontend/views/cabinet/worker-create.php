<?php

use frontend\models\LaborActivity;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $worker frontend\models\Worker */

$this->title = Yii::t('app', 'Update Lang: {name}', [
    'name' => $worker->firstname,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Langs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $worker->firstname, 'url' => ['view', 'id' => $worker->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Create');
?>



<?= $this->render('worker-form', [
  'worker' => $worker,
  'modelsLaborActivity' => (empty($modelsLaborActivity)) ? [new LaborActivity] : $modelsLaborActivity
]) ?>