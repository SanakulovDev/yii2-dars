<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 *
 * @var \frontend\models\VacancyOrders $vacancyOrders
 * @var \frontend\models\Worker $worker
 * @var \frontend\models\Company $company
 */

$statuslist = \frontend\models\ApplyStatus::selectList();

?>

<h3><?= Yii::t('app', 'Cv list') ?></h3>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<table class="table table-hover table-bordered table-striped">
    <thead>
    <tr>
        <th><?=Yii::t('app','Id')?></th>
        <th><?=Yii::t('app','Firstname')?></th>
        <th><?=Yii::t('app','Lastname')?></th>
        <th><?=Yii::t('app','Cv')?></th>
        <th><?=Yii::t('app','Phone')?></th>
        <th><?=Yii::t('app','Rate')?></th>

    </tr>
    </thead>

    <tbody>
    <?php foreach ($vacancyOrders as $item):?>
    <tr>
        <td><?=$item->id?></td>
        <td><?=$item->worker->firstname?></td>
        <td><?=$item->worker->lastname?></td>
        <td><?= Html::a(Yii::t('app','Show'),"/cabinet/cv-download?id=".$worker->id)?></td>
        <td><?=$item->worker->phone?></td>
        <td>
<!--            --><?//= $form->field($vacancyOrders,'status')->textInput()?>
        </td>
    </tr>
    <?php endforeach;?>
    </tbody>
</table>

<?php ActiveForm::end(); ?>
