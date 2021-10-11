<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $worker frontend\models\Worker */
$regionList = \common\models\Region::selectList();
$cityList = \common\models\City::selectList($model->regionId);
$this->title = Yii::t('app', 'Update Lang: {name}', [
'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Langs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

    <h2 class="mb-4"><?= Yii::t('app', 'Edit company information') ?></h2>

<?= $this->render('worker-form', [
    'worker' => $worker,
]) ?>