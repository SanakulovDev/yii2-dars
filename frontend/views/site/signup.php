<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model \common\models\LoginForm */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
$regionList = \common\models\Region::selectList();
$cityList = \common\models\City::selectList($model->regionId);
?>


<div class="site-login">
    <section class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php if (Yii::$app->session->hasFlash('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <?= Yii::$app->session->getFlash('success') ?>
                        </div>
                    <?php endif; ?>
                    <?php if (Yii::$app->session->hasFlash('danger')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <?= Yii::$app->session->getFlash('error') ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div >
                <h3><?= Yii::t('app','Are you an employer or a job seeker?')?></h3>
                <div id="accordion" class=" row">
                    <div class="card col-md-6 p-0">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                        aria-controls="collapseOne">
                                    <?= Yii::t('app', 'Employer') ?>
                                </button>
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body ">
                                <div class="col-lg-6" style="max-width: 100%!important;">
                                    <h2 class="mb-4"><?= Yii::t('app', 'Signup') ?></h2>
                                    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                                    <div class="row form-group mb-4">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <?= $form->field($model, 'username') ?>
                                        </div>
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <?= $form->field($model, 'password')->passwordInput() ?>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
                                        </div>

                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <?= $form->field($model, 'director_name')->textInput() ?>
                                        </div>
                                    </div>
                                    <div class="row form-group mb-4">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <?= $form->field($model, 'regionId')->dropdownList($regionList) ?>
                                        </div>
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <?= $form->field($model, 'cityId')->dropdownList($cityList) ?>
                                        </div>

                                    </div>
                                    <div class="row form-group mb-4">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <?= $form->field($model, 'address')->textInput() ?>
                                        </div>
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::class, [
                                                'mask' => '+\9\98-99-999-9999',
                                            ]) ?>
                                        </div>
                                    </div>
                                    <div class="row form-group mb-4">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <?= $form->field($model, 'logo')->fileInput() ?>
                                        </div>

                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <?= $form->field($model, 'email') ?>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-12">
                                            <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                                        </div>
                                    </div>

                                    <?php ActiveForm::end(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card col-md-6 p-0">
                        <div class="card-header" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed d-block" data-toggle="collapse" data-target="#collapseTwo"
                                        aria-expanded="false" aria-controls="collapseTwo">
                                    <?= Yii::t('app', 'Job seeker') ?>
                                </button>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body ">
                                <div class="col-lg-6" style="max-width: 100%!important;">
                                    <h2 class="mb-4"><?= Yii::t('app', 'Signup') ?></h2>
                                    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                                    <div class="row form-group">
                                        <div class="col-md-12 mb-3 mb-md-0">
                                            <?= $form->field($model, 'username') ?>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col-md-12 mb-3 mb-md-0">
                                            <?= $form->field($model, 'email') ?>
                                        </div>
                                    </div>

                                    <div class="row form-group mb-4">
                                        <div class="col-md-12 mb-3 mb-md-0">
                                            <?= $form->field($model, 'password')->passwordInput() ?>
                                        </div>
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-12">
                                            <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                                        </div>
                                    </div>

                                    <?php ActiveForm::end(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

