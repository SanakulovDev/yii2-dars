<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $worker frontend\models\Worker */
$regionList = \common\models\Region::selectList();
$cityList = \common\models\City::selectList($worker->regionId);
$this->title = Yii::t('app', 'Update Lang: {name}', [
    'name' => $worker->firstname,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Langs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $worker->firstname, 'url' => ['view', 'id' => $worker->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Create');
?>


    <h2 class="mb-4"><?= Yii::t('app', 'Edit company information') ?></h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor, ducimus minima. Culpa distinctio dolores hic
        incidunt modi nisi nulla soluta. Deserunt dignissimos libero maiores minus officia perferendis quis rem
        saepe.</p>
<? //= $this->render('worker-form', [
//    'model' => $worker,
//]) ?>