<?php

use kartik\select2\Select2;
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




    <?= $form->field($model, 'profession_id')->widget(Select2::classname(), [
        'data' => $profession,
        'language' => 'de',
        'options' => ['placeholder' => 'Select a profession ...','class'=>'form-control'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
    <?= $form->field($model, 'job_type_id')->dropDownList($job_type, ['prompt' => 'Select a job type']) ?>

    <?= $form->field($model, 'region_id')->dropDownList($region, ['prompt' => 'Select a region']) ?>

    <?= $form->field($model, 'city_id')->dropDownList($city, ['prompt' => 'Select a city']) ?>

    <?= $form->field($model, 'gender')->dropDownList($gender, ['prompt' => 'Select a gender']) ?>


    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'salary_begin')->textInput(['type' => 'number']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'salary_end')->textInput(['type' => 'number']) ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Reset'), 'vacancy-view-all', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
