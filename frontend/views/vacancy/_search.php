<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\VacancySearch */
/* @var $form yii\widgets\ActiveForm */

$profession = \common\models\Profession::selectList();
$region = \common\models\Region::selectList();
$job_type = \common\models\JobType::selectList();
$city = [];
?>

<div class="vacancy-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>





    <?= $form->field($model, 'profession_id')->dropDownList($profession,['prompt'=>'Select a profession']) ?>

    <?= $form->field($model, 'job_type_id')->dropDownList($job_type,['prompt'=>'Select a job type']) ?>

    <?= $form->field($model, 'region_id')->dropDownList($job_type,['prompt'=>'Select a region']) ?>

    <?= $form->field($model, 'city_id')->dropDownList($job_type,['prompt'=>'Select a city']) ?>



    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
