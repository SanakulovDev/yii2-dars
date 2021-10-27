<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;

/* @var $apply_vacancy frontend\models\ApplyVacancy */
?>
<div class="apply-vacancy">

    <div class="container">
        <?php
        $identity = Yii::$app->user->identity;
        echo Breadcrumbs::widget([
            'itemTemplate' => "<li>{link}</li>\n",
            'links' => [
                [
                    'label' => '/' . Yii::t('app', 'Vacancy view all') . '/',
                    'url' => ['site/vacancy-view-all'],
                ],
                [
                    'label'=>Yii::t('app','Vacancy views').'/',
                    'url'=>['site/vacancy-views', 'id'=>$_GET['id']]
                ],
                Yii::t('app','Apply Vacancy')
            ],
        ]);
        ?>
        <h2><?= Yii::t('app', 'Apply now') ?></h2>
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'class' => 'p-4 p-md-5 border rounded']]); ?>
        <?php
        ?>
        <div class="form-group row ">
            <div class="col-md-6">
                <?= $form->field($apply_vacancy, 'firstname')->textInput() ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($apply_vacancy, 'lastname')->textInput() ?>
            </div>
        </div>
        <div class="form-group row ">
            <div class="col-md-12">
                <?= $form->field($apply_vacancy, 'purpose')->textarea() ?>
            </div>
        </div>
        <div class="form-group row ">
            <div class="col-md-6">
                <?= $form->field($apply_vacancy, 'email')->textInput() ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($apply_vacancy, 'rezume')->fileInput() ?>
            </div>

        </div>
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary', 'name' => 'apply-button']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</div>