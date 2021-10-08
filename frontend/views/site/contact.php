<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model \frontend\models\ContactForm */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;


$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact container">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        If you have business inquiries or other questions, please fill out the following form to contact us. Thank you.
    </p>
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>
    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>

    <section class="site-section" id="next-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <?php $form = ActiveForm::begin(['options'=>['enctype' => 'multipart/form-data']]); ?>

                        <div class="row form-group">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <?= $form->field($model, 'firstname')->textInput(['autofocus' => true]) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($model, 'lastname')->textInput() ?>
                            </div>
                        </div>

                        <div class="row form-group">

                            <div class="col-md-12">
                                <?= $form->field($model, 'email') ?>
                            </div>
                        </div>

                        <div class="row form-group">

                            <div class="col-md-12">
                                <?= $form->field($model, 'subject') ?>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                            </div>
                        </div>


                    <?php ActiveForm::end(); ?>
                </div>
                <div class="col-lg-5 ml-auto">
                    <div class="p-4 mb-3 bg-white">
                        <p class="mb-0 font-weight-bold">Address</p>
                        <p class="mb-4"><?= Yii::$app->params['address'] ?></p>

                        <p class="mb-0 font-weight-bold">Phone</p>
                        <p class="mb-4"><a href="#"><?= Yii::$app->params['phone'] ?></a></p>

                        <p class="mb-0 font-weight-bold">Email Address</p>
                        <p class="mb-0"><a href="#"><?= Yii::$app->params['supportEmail'] ?></a></p>

                    </div>
                </div>
            </div>
        </div>

    </section>

    <?php
    echo yii2mod\google\maps\markers\GoogleMaps::widget([
        'userLocations' => [
            [
                'location' => [
                    'address' => 'Kharkiv',
                    'country' => 'Ukraine',
                ],
                'htmlContent' => '<h1>Kharkiv</h1>',
            ],
            [
                'location' => [
                    'city' => 'New York',
                    'country' => 'United States',
                ],
                'htmlContent' => '<h1>New York</h1>',
            ],
        ],
    ]);
    ?>

</div>
