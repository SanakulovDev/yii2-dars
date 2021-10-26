<?php

use dosamigos\tinymce\TinyMce;
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
                            <?= $form->field($model, 'job_type_id')->dropDownList($jobtype, ['prompt' => Yii::t('app','Select the job type')]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'profession_id')->dropDownList($profession, ['prompt' => Yii::t('app','Choose a career type')]) ?>
                        </div>
                    </div>
                    <div class="form-group row">

                        <div class="col-md-6">
                            <?= $form->field($model, 'image')->fileInput() ?>
                        </div>

                    </div>

                    <div class="form-group">



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
                                <?= $form->field($model, 'description_uz')->widget(TinyMce::className(), [
                                    'options' => ['rows' => 6],
                                    'language' => 'en',
                                    'clientOptions' => [
                                        'plugins' => [
                                            "advlist autolink lists link charmap print preview anchor",
                                            "searchreplace visualblocks code fullscreen",
                                            "insertdatetime media table contextmenu paste",
                                            "save image imagetools textcolor fullscreen charmap"
                                        ],
                                        'toolbar' => "save | undo redo | code styleselect | fontselect fontsizeselect hilitecolor forecolor backcolor bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image imagetools media fullscreen charmap | redbtn defaultbuttons roundbuttons numscroller anchor",
                                        'fontsize_formats' => '8pt 10pt 12pt 14pt 18pt 20pt 24pt 36pt',
                                        'image_advtab' => true,
                                        'image_class_list' => [
                                            [
                                                'value' => '',
                                                'title' => 'None',
                                            ],
                                            [
                                                'value' => 'img-circle img-no-padding img-responsive',
                                                'title' => 'Circle',
                                            ],
                                            [
                                                'value' => 'img-rounded img-responsive',
                                                'title' => 'Rounded',
                                            ],
                                            [
                                                'value' => 'img-thumbnail img-responsive',
                                                'title' => 'Thumbnail',
                                            ]
                                        ],
                                        'images_upload_url' => '/posAcceptor.php',
                                        'plugin_prevqiew_width' => 1110,
                                    ]
                                ]);?>
                            </div>
                            <div class="tab-pane fade" id="descen" role="tabpanel" aria-labelledby="descen-tab">
                                <?= $form->field($model, 'description_en')->widget(TinyMce::className(), [
                                    'options' => ['rows' => 6],
                                    'language' => 'en',
                                    'clientOptions' => [
                                        'plugins' => [
                                            "advlist autolink lists link charmap print preview anchor",
                                            "searchreplace visualblocks code fullscreen",
                                            "insertdatetime media table contextmenu paste",
                                            "save image imagetools textcolor fullscreen charmap"
                                        ],
                                        'toolbar' => "save | undo redo | code styleselect | fontselect fontsizeselect hilitecolor forecolor backcolor bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image imagetools media fullscreen charmap | redbtn defaultbuttons roundbuttons numscroller anchor",
                                        'fontsize_formats' => '8pt 10pt 12pt 14pt 18pt 20pt 24pt 36pt',
                                        'image_advtab' => true,
                                        'image_class_list' => [
                                            [
                                                'value' => '',
                                                'title' => 'None',
                                            ],
                                            [
                                                'value' => 'img-circle img-no-padding img-responsive',
                                                'title' => 'Circle',
                                            ],
                                            [
                                                'value' => 'img-rounded img-responsive',
                                                'title' => 'Rounded',
                                            ],
                                            [
                                                'value' => 'img-thumbnail img-responsive',
                                                'title' => 'Thumbnail',
                                            ]
                                        ],
                                        'images_upload_url' => '/posAcceptor.php',
                                        'plugin_prevqiew_width' => 1110,
                                    ]
                                ]);?>
                            </div>
                            <div class="tab-pane fade" id="descru" role="tabpanel" aria-labelledby="descru-tab">
                                <?= $form->field($model, 'description_ru')->widget(TinyMce::className(), [
                                    'options' => ['rows' => 6],
                                    'language' => 'en',
                                    'clientOptions' => [
                                        'plugins' => [
                                            "advlist autolink lists link charmap print preview anchor",
                                            "searchreplace visualblocks code fullscreen",
                                            "insertdatetime media table contextmenu paste",
                                            "save image imagetools textcolor fullscreen charmap"
                                        ],
                                        'toolbar' => "save | undo redo | code styleselect | fontselect fontsizeselect hilitecolor forecolor backcolor bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image imagetools media fullscreen charmap | redbtn defaultbuttons roundbuttons numscroller anchor",
                                        'fontsize_formats' => '8pt 10pt 12pt 14pt 18pt 20pt 24pt 36pt',
                                        'image_advtab' => true,
                                        'image_class_list' => [
                                            [
                                                'value' => '',
                                                'title' => 'None',
                                            ],
                                            [
                                                'value' => 'img-circle img-no-padding img-responsive',
                                                'title' => 'Circle',
                                            ],
                                            [
                                                'value' => 'img-rounded img-responsive',
                                                'title' => 'Rounded',
                                            ],
                                            [
                                                'value' => 'img-thumbnail img-responsive',
                                                'title' => 'Thumbnail',
                                            ]
                                        ],
                                        'images_upload_url' => '/posAcceptor.php',
                                        'plugin_prevqiew_width' => 1110,
                                    ]
                                ]);?>
                            </div>
                            <div class="tab-pane fade" id="desccyrl" role="tabpanel" aria-labelledby="desccyrl-tab">
                                <?= $form->field($model, 'description_cyrl')->widget(TinyMce::className(), [
                                    'options' => ['rows' => 6],
                                    'language' => 'en',
                                    'clientOptions' => [
                                        'plugins' => [
                                            "advlist autolink lists link charmap print preview anchor",
                                            "searchreplace visualblocks code fullscreen",
                                            "insertdatetime media table contextmenu paste",
                                            "save image imagetools textcolor fullscreen charmap"
                                        ],
                                        'toolbar' => "save | undo redo | code styleselect | fontselect fontsizeselect hilitecolor forecolor backcolor bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image imagetools media fullscreen charmap | redbtn defaultbuttons roundbuttons numscroller anchor",
                                        'fontsize_formats' => '8pt 10pt 12pt 14pt 18pt 20pt 24pt 36pt',
                                        'image_advtab' => true,
                                        'image_class_list' => [
                                            [
                                                'value' => '',
                                                'title' => 'None',
                                            ],
                                            [
                                                'value' => 'img-circle img-no-padding img-responsive',
                                                'title' => 'Circle',
                                            ],
                                            [
                                                'value' => 'img-rounded img-responsive',
                                                'title' => 'Rounded',
                                            ],
                                            [
                                                'value' => 'img-thumbnail img-responsive',
                                                'title' => 'Thumbnail',
                                            ]
                                        ],
                                        'images_upload_url' => '/posAcceptor.php',
                                        'plugin_prevqiew_width' => 1110,
                                    ]
                                ]);?>
                            </div>
                        </div>



                    </div>



                    <div class="form-group row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'region_id')->dropDownList($regionList,['prompt' => Yii::t('app','Select a region')]) ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'city_id')->dropDownList($cityList,['prompt' => Yii::t('app','Select a city')]) ?>
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


