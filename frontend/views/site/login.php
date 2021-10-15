<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */

/* @var $model \common\models\LoginForm */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
$regionList = \common\models\Region::selectList();
?>
<div class="site-login">

    <section class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="mb-4"><?=Yii::t('app','Login')?></h2>
                    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'class'=>'p-4 border rounded']]); ?>
                        <div class="row form-group">
                            <div class="col-md-12 mb-3 mb-md-0">
                                <?= $form->field($model, 'username') ?>
                            </div>
                        </div>
                        <div class="row form-group mb-4">
                            <div class="col-md-12 mb-3 mb-md-0">
                                <?= $form->field($model, 'password')->passwordInput() ?>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <?= Html::submitButton(Yii::t('app','Login'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                            </div>
                        </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </section>

</div>
