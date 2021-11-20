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
        <th><?= Yii::t('app', 'Rate') ?></th>

    </tr>
    </thead>

    <tbody>
    <?php  if ($vacancyOrders != null):?>
    <?php foreach ($vacancyOrders as $item): ?>
        <tr>
            <td><?= ++$id ?></td>
            <td><?= $item->worker->firstname ?></td>
            <td><?= $item->vacancy->profession->$name ?></td>
            <td><?= Html::a(Yii::t('app', 'Show'), "/cabinet/cv-download?id=" . $item->worker_id) ?></td>
            <td><?= $item->worker->phone ?></td>
            <td id="vacancyOrders">
                <?= VacancyOrders::STATUSLIST[$item->status]?>
            </td>
            <td><?= $item->created_at ?></td>
            <td>
                <a  class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                    <?= VacancyOrders::STATUSLIST[$item->status]?>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="rate-vacancy?id=<?=$item->id?>&action=1"><?=Yii::t('app','Canceled')?></a>
                    <a class="dropdown-item" href="rate-vacancy?id=<?=$item->id?>&action=2"><?= Yii::t('app','Called for an interview')?></a>
                    <a class="dropdown-item" href="rate-vacancy?id=<?=$item->id?>&action=3"><?= Yii::t('app','He was invited to work')?></a>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
    <?php endif;?>
    </tbody>
</table>

<?php ActiveForm::end(); ?>
