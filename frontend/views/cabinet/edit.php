<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Lang */
$regionList = \common\models\Region::selectList();
$cityList = \common\models\City::selectList($model->regionId);
$this->title = Yii::t('app', 'Update Lang: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Langs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
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
    <div class="col-md-6 mb-3 mb-md-0">
        <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
    </div>

    <div class="col-md-6 mb-3 mb-md-0">
        <?= $form->field($model, 'director_name')->textInput() ?>
    </div>
</div>
<div class="row form-group ">
    <div class="col-md-6 mb-3 mb-md-0">
        <?= $form->field($model, 'regionId')->dropdownList($regionList) ?>
    </div>
    <div class="col-md-6 mb-3 mb-md-0">
        <?= $form->field($model, 'cityId')->dropdownList($cityList) ?>
    </div>

</div>
<div class="row form-group ">
    <div class="col-md-6 mb-3 mb-md-0">
        <?= $form->field($model, 'address')->textInput() ?>
    </div>
    <div class="col-md-6 mb-3 mb-md-0">
        <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::class, [
            'mask' => '+\9\98-99-999-9999',
        ]) ?>
    </div>
</div>
<div class="row form-group ">
    <div class="col-md-6 mb-3 mb-md-0">
        <?= $form->field($model, 'image')->fileInput() ?>
    </div>


</div>

<div class="row form-group">
    <div class="col-md-12">
        <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>



