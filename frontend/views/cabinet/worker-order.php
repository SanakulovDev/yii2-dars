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
$id = 0;
?>

<h3><?= Yii::t('app', 'Cv list') ?></h3>
    <?php
    ?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<table class="table table-hover table-bordered table-striped">
    <thead>
    <tr>
        <th><?= Yii::t('app', 'Id') ?></th>
        <th><?= Yii::t('app', 'Company') ?></th>
        <th><?= Yii::t('app', 'Status') ?></th>
        <th><?= Yii::t('app', 'Created_at') ?></th>
        <th><?= Yii::t('app', 'Date approval') ?></th>

    </tr>
    </thead>

    <tbody>
    <?php foreach ($vacancyOrders as $item): ?>
        <tr>
            <td><?= ++$id ?></td>
            <td><?= $item->company->name ?></td>
            <td><?= isset(VacancyOrders::STATUSLIST[$item->status]) ? VacancyOrders::STATUSLIST[$item->status] : 'Topilmadi' ?></td>
            <td><?= $item->created_at?></td>
            <td><?= $item->date_approval?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php ActiveForm::end(); ?>

