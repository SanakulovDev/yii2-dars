<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Vacancy */
/* @var $form yii\widgets\ActiveForm */

$profession = \common\models\Profession::selectList();
$jobtype = \common\models\JobType::selectList();
$regionList = \common\models\Region::selectList();
$cityList = [];

?>

<div class="vacancy-form">


    <section class="site-section p-0">
        <div class="container">

            <div class="row mb-5">
                <div class="col-lg-12">
                    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'class' => 'p-4 p-md-5 border rounded']]); ?>
                    <h3 class="text-black mb-5 border-bottom pb-2"><?= Yii::t('app', 'Job Details') ?></h3>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'job_type_id')->dropDownList($jobtype) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'profession_id')->dropDownList($profession) ?>
                        </div>
                    </div>
                    <div class="form-group row">

                        <div class="col-md-6">
                            <?= $form->field($model, 'image')->fileInput() ?>
                        </div>

                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'description_uz')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'description_en')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'description_cyrl')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'description_ru')->textInput(['maxlength' => true]) ?>
                        </div>

                    </div>


                    <div class="form-group row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'region_id')->dropDownList($regionList) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'city_id')->dropDownList($cityList) ?>
                        </div>

                    </div>


                    <div class="form-group row">
                        <div class="col-md-4">
                            <?= $form->field($model, 'count_vacancy')->textInput() ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'salary')->textInput() ?>
                        </div>
                        <div class="col-md-4">
                            <?= $form->field($model, 'gender')->textInput() ?>
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'telegram')->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-md-12">
                            <?= $form->field($model, 'deadline')->textInput(['maxlength' => true]) ?>

                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <?= $form->field($model, 'experience')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div><?= $form->field($model, 'deadline')->textInput(['maxlength' => true]) ?>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>


            </div>
        </div>
    </section>


</div>
