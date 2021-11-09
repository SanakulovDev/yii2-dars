<?php

use frontend\models\VacancyOrders;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/**
 *
 * @var \frontend\models\VacancyOrders $vacancyOrders
 * @var \frontend\models\Worker $worker
 * @var \frontend\models\Company $company
 */

$statuslist = \frontend\models\ApplyStatus::selectList();
$name = 'name_' . Yii::$app->language;
$id = 0;
?>

<h3><?= Yii::t('app', 'Cv list') ?></h3>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<table class="table table-hover table-bordered table-striped">
    <thead>
    <tr>
        <th><?= Yii::t('app', 'Id') ?></th>
        <th><?= Yii::t('app', 'Firstname') ?></th>
        <th><?= Yii::t('app', 'Vacancy name') ?></th>
        <th><?= Yii::t('app', 'Cv') ?></th>
        <th><?= Yii::t('app', 'Phone') ?></th>
        <th><?= Yii::t('app', 'Status') ?></th>
        <th><?= Yii::t('app', 'Created_at') ?></th>
        <th></th>

    </tr>
    </thead>

    <tbody>
    <?php foreach ($vacancyOrders as $item): ?>
        <tr>
            <td><?= ++$Id ?></td>
            <td><?= $item->worker->firstname ?></td>
            <td><?= $item->vacancy->profession->$name ?></td>
            <td><?= Html::a(Yii::t('app', 'Show'), "/cabinet/cv-download?id=" . $item->worker_id) ?></td>
            <td><?= $item->worker->phone ?></td>
            <!--            <td>-->
            <? //= $form->field($item, 'status')->dropDownList(VacancyOrders::STATUSLIST)?><!--</td>-->
            <td><?= isset(VacancyOrders::STATUSLIST[$item->status == 0]) ? $form->field($item, 'status')->dropDownList(VacancyOrders::STATUSLIST) : VacancyOrders::STATUSLIST[$item->status] ?></td>
            <td><?= $item->created_at ?></td>
            <td><?= Html::submitButton(Yii::t('app','Save'),['class'=>'btn btn-outline-success'])?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php ActiveForm::end(); ?>
