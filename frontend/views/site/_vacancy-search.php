<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\VacancySearch */
/* @var $form yii\widgets\ActiveForm */

$profession = \common\models\Profession::selectList();
$region = \common\models\Region::selectList();
$job_type = \common\models\JobType::selectList();
$gender = \common\models\Gender::selectList();
$city = [];
?>

<div class="vacancy-search">

    <?php $form = ActiveForm::begin([
        'action' => ['vacancy-view-all'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>





    <?= $form->field($model, 'profession_id')->dropDownList($profession,['prompt' => 'Select a profession']) ?>

    <?= $form->field($model, 'job_type_id')->dropDownList($job_type,['prompt' => 'Select a job type']) ?>

    <?= $form->field($model, 'region_id')->dropDownList($region,['prompt' => 'Select a region']) ?>

    <?= $form->field($model, 'city_id')->dropDownList($city,['prompt' => 'Select a city']) ?>

    <?= $form->field($model, 'gender')->dropDownList($gender,['prompt' => 'Select a gender']) ?>

    <?= $form->field($model, 'salary')?>
<!--    --><?//= $form->field($model, 'salary2')?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
