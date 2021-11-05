<?php

/**
 * @var \frontend\models\LaborActivity $modelsLaborActivity
 * @var \frontend\models\Worker $worker
 * @var \frontend\models\WorkerLanguage $modelsWorkerLanguage
 */

use frontend\models\WorkerLanguage;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$regionList = \common\models\Region::selectList();
$cityList = \common\models\City::selectList($worker->regionId);
$nationality = \frontend\models\Nationality::selectList();
$genderList = \common\models\Gender::selectList();
$profession_list = \common\models\Profession::selectList();
$language_list = \common\models\Language::selectList();


$js = '
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("LaborActivity: " + (index + 1))
    });
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
        jQuery(this).html("LaborActivity: " + (index + 1))
    });
});

jQuery(".dynamicform_wrapper_language").on("afterInsert", function(e, item) {
    jQuery(".dynamicform_wrapper_language .panel-title-language").each(function(index) {
        jQuery(this).html("Worker Language: " + (index + 1))
    });
});

jQuery(".dynamicform_wrapper_language").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper_language .panel-title-language").each(function(index) {
        jQuery(this).html("Worker Language: " + (index + 1))
    });
});

';

$this->registerJs($js);
?>

<h2 class="mb-4"><?= Yii::t('app', 'Edit worker information') ?></h2>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'id' => 'dynamic-form']]); ?>
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
    <div class="col-md-6 mb-3">
        <?= DatePicker::widget([
            'name' => 'birthdate',
            'options' => ['placeholder' => 'Select a birthdate'],
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
            ]
        ]);
        ?>
    </div>
</div>
<div class="row form-group ">
    <div class="col-md-4 mb-3 ">
        <?= $form->field($worker, 'regionId')->dropDownList($regionList, ['prompt' => 'Select a region']) ?>
    </div>
    <div class="col-md-4 mb-3 ">
        <?= $form->field($worker, 'cityId')->dropDownList($cityList, ['prompt' => 'Select a city']) ?>
    </div>
    <div class="col-md-4 mb-3">
        <?= $form->field($worker, 'profession_id')->dropDownList($profession_list, ['prompt' => 'Select a profession']) ?>
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
        <?= $form->field($worker, 'gender')->dropDownList($genderList) ?>
    </div>
    <div class="col-md-6 mb-3">
        <?= $form->field($worker, 'nationality_id')->dropDownList($nationality) ?>
    </div>
</div>
<div class="row form-group">
    <div class="col-md-6 mb-3">
        <?= $form->field($worker, 'hobby')->textInput() ?>
    </div>
    <div class="col-md-6 mb-3 ">
        <?= $form->field($worker, 'photo')->fileInput() ?>
    </div>
</div>

<!--Dynamic form labor activity-->

<div class="row">
    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 4, // the maximum times, an element can be cloned (default 999)
        'min' => 1, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $modelsLaborActivity[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'company_name',
            'position',
            'form_date',
            'to_date'
        ],
    ]); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-envelope"></i> LaborActivity Book
            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i
                        class="fa fa-plus"></i> <?= Yii::t('app', 'Add Labor Activity') ?></button>
            <div class="clearfix"></div>
        </div>


        <div class="panel-body container-items"><!-- widgetContainer -->
            <?php foreach ($modelsLaborActivity as $index => $modelLaborActivity): ?>

                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <span class="panel-title-address">LaborActivity: <?= ($index + 1) ?></span>
                        <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i
                                    class="fa fa-minus"></i></button>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                        // necessary for update action.
                        if (!$modelLaborActivity->isNewRecord) {
                            echo Html::activeHiddenInput($modelLaborActivity, "[{$index}]id");
                        }
                        ?>


                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($modelLaborActivity, "[{$index}]company_name")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelLaborActivity, "[{$index}]position")->textInput(['maxlength' => true]) ?>
                            </div>

                        </div><!-- end:row -->

                        <div class="row">
                            <div class="col-sm-6">
                                <?= DatePicker::widget([
                                    'name' => 'form_date',
                                    'value' => '',
                                    'options' => ['placeholder' => 'Select issue date ...'],
                                    'pluginOptions' => [
                                        'format' => 'yyyy-mm-dd',
                                    ]
                                ]);
                                ?>
                            </div>

                            <div class="col-sm-6">
                                <?= DatePicker::widget([
                                    'name' => 'to_date',
                                    'value' => '',
                                    'options' => ['placeholder' => 'Select issue date ...'],
                                    'pluginOptions' => [
                                        'format' => 'yyyy-mm-dd',
                                        'todayHighlight' => true
                                    ]
                                ]);
                                ?>
                            </div>
                        </div><!-- end:row -->

                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php DynamicFormWidget::end(); ?>


</div>
<!--Dynamic form Model language-->
<div class="row">
    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper_language', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items-language', // required: css class selector
        'widgetItem' => '.item-language', // required: css class
        'limit' => 4, // the maximum times, an element can be cloned (default 999)
        'min' => 1, // 0 or 1 (default 1)
        'insertButton' => '.add-item-language', // css class
        'deleteButton' => '.remove-item-language', // css class
        'model' => $modelsWorkerLanguage[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'language_id',
            'rate'
        ],
    ]); ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-envelope"></i> WorkerLanguage Book
            <button type="button" class="pull-right add-item-language btn btn-success btn-xs"><i
                        class="fa fa-plus"></i> <?= Yii::t('app', 'Add Worker language') ?></button>
            <div class="clearfix"></div>
        </div>


        <div class="panel-body container-items-language"><!-- widgetContainer -->
            <?php foreach ($modelsWorkerLanguage

            as $index => $modelWorkerLanguage): ?>

            <div class="item-language panel panel-default"><!-- widgetBody -->
                <div class="panel-heading">
                    <span class="panel-title-language">WorkerLanguage: <?= ($index + 1) ?></span>
                    <button type="button" class="pull-right remove-item-language btn btn-danger btn-xs"><i
                                class="fa fa-minus"></i></button>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <?php
                    // necessary for update action.
                    if (!$modelWorkerLanguage->isNewRecord) {
                        echo Html::activeHiddenInput($modelWorkerLanguage, "[{$index}]id");
                    }
                    ?>


                    <div class="row">
                        <div class="col-sm-6">
                            <?= $form->field($modelWorkerLanguage, "[{$index}]language_id")->dropDownList($language_list, ['prompt' => Yii::t('app', 'Select a language')]) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= $form->field($modelWorkerLanguage, "[{$index}]rate")->dropDownList([1, 2, 3, 4, 5], ['prompt' => Yii::t('app', 'Select a rate')]) ?>
                        </div>

                    </div><!-- end:row -->


                </div><!-- end:row -->

            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php DynamicFormWidget::end(); ?>
</div>
<div class="row form-group">

    <div class="col-md-12">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>





