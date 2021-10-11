<?php

use yii\widgets\ActiveForm;

?>

<h2 class="mb-4"><?= Yii::t('app', 'Edit company information') ?></h2>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
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
<div class="row form-group">
    <div class="col-md-6 mb-3 ">
        <?= $form->field($worker, 'firstname')->textInput(['autofocus' => true]) ?>
    </div>

    <div class="col-md-6 mb-3 ">
        <?= $form->field($worker, 'lastname')->textInput() ?>
    </div>
</div>
<div class="row form-group">
    <div class="col-md-6 mb-3">
        <?= $form->field($worker, 'patronymic')->textInput() ?>
    </div>
</div>
<div class="row form-group ">
    <div class="col-md-6 mb-3 ">
        <?= $form->field($worker, 'regionId')->dropdownList($regionList) ?>
    </div>
    <div class="col-md-6 mb-3 ">
        <?= $form->field($worker, 'cityId')->dropdownList($cityList) ?>
    </div>
</div>
<div class="row form-group ">
    <div class="col-md-6 mb-3 ">
        <?= $form->field($worker, 'address')->textInput() ?>
    </div>
    <div class="col-md-6 mb-3 ">
        <?= $form->field($worker, 'phone')->widget(\yii\widgets\MaskedInput::class, [
            'mask' => '+\9\98-99-999-9999',
        ]) ?>
    </div>
</div>
<div class="row form-group">
    <div class="col-md-6 mb-3">
        <?= $form->field($worker, 'patr')->textInput() ?>
    </div>
</div>
<div class="row form-group ">
    <div class="col-md-6 mb-3 ">
        <?= $form->field($worker, 'image')->fileInput() ?>
    </div>


</div>

<div class="row form-group">
    <div class="col-md-12">
        <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>



