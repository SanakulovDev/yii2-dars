<?php

use kartik\select2\Select2;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model frontend\models\Vacancy */
/* @var $form yii\widgets\ActiveForm */

$profession = \common\models\Profession::selectList();
$jobtype = \common\models\JobType::selectList();
$regionList = \common\models\Region::selectList();
$cityList = [];
$genderList = \common\models\Gender::selectList();


?>

<style>
    #vacancy-profession_id{
        visibility: visible!important;
    }
</style>
<div class="vacancy-form">


    <section class="site-section p-0">
        <div class="container">

            <div class="row mb-5">
                <div class="col-lg-12">
                    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'class' => 'p-4 p-md-5 border rounded']]); ?>
                    <h3 class="text-black mb-5 border-bottom pb-2"><?= Yii::t('app', 'Job Details') ?></h3>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'job_type_id')->dropDownList($jobtype, ['prompt' => 'Ish turini tanlang']) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'profession_id')->dropDownList($profession, ['prompt' => 'Kasb turini tanlang']) ?>
                        </div>
                    </div>
                    <div class="form-group row">

                        <div class="col-md-6">
                            <?= $form->field($model, 'image')->fileInput() ?>
                        </div>

                    </div>

                    <div class="form-group row">



                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="descuz-tab" data-toggle="tab" href="#descuz" role="tab" aria-controls="descuz" aria-selected="true">
                                    <?=Yii::t('app','Description_uz')?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="descen-tab" data-toggle="tab" href="#descen" role="tab" aria-controls="descen" aria-selected="false">
                                    <?=Yii::t('app','Description_en')?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="descru-tab" data-toggle="tab" href="#descru" role="tab" aria-controls="descru" aria-selected="false">
                                    <?=Yii::t('app','Description_ru')?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="desccyrl-tab" data-toggle="tab" href="#desccyrl" role="tab" aria-controls="desccyrl" aria-selected="false">
                                    <?=Yii::t('app','Description_cyrl')?>
                                </a>
                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="descuz" role="tabpanel" aria-labelledby="descuz-tab">
                                <?php echo $form->field($model, 'description_uz')->widget(CKEditor::className(),[
                                    'editorOptions' => [
//                            'preset' => 'full',
                                        'inline' => false,

                                    ],
                                ]);
                                ?>
                            </div>
                            <div class="tab-pane fade" id="descen" role="tabpanel" aria-labelledby="descen-tab">
                                <?php echo $form->field($model, 'description_en')->widget(CKEditor::className(),[
                                    'editorOptions' => [
//                            'preset' => 'full',
                                        'inline' => false,

                                    ],
                                ]);
                                ?>
                            </div>
                            <div class="tab-pane fade" id="descru" role="tabpanel" aria-labelledby="descru-tab">
                                <?php echo $form->field($model, 'description_ru')->widget(CKEditor::className(),[
                                    'editorOptions' => [
//                            'preset' => 'full',
                                        'inline' => false,

                                    ],
                                ]);
                                ?>
                            </div>
                            <div class="tab-pane fade" id="desccyrl" role="tabpanel" aria-labelledby="desccyrl-tab">
                                <?php echo $form->field($model, 'description_cyrl')->widget(CKEditor::className(),[
                                    'editorOptions' => [
//                            'preset' => 'full',
                                        'inline' => false,

                                    ],
                                ]);
                                ?>
                            </div>
                        </div>



                    </div>



                    <div class="form-group row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'region_id')->dropDownList($regionList,['prompt' => 'Viloyatni tanlang']) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'city_id')->dropDownList($cityList,['prompt' => 'Shaharni tanlang']) ?>
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
                            <?= $form->field($model, 'gender')->dropDownList($genderList) ?>
                        </div>
                    </div>


                    <div class="form-group row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'telegram')->textInput(['maxlength' => true]) ?>
                        </div>
<!--                        <div class="col-md-12">-->
<!--                            --><?//= $form->field($model,'deadline')->textInput(['placeholder'=>'yyyy-mm-dd'])   ?>
<!--                        </div>-->
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <?= $form->field($model, 'experience')->textInput(['maxlength' => true]) ?>
                        </div>
                    </div>

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


