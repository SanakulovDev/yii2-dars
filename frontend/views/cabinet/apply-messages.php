<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 *
 * @var \frontend\models\VacancyOrders $vacancyOrders
 * @var \frontend\models\Worker $worker
 */

$statuslist = \frontend\models\ApplyStatus::selectList();
?>

    <h3><?=Yii::t('app','Cv list')?></h3>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="row">
    <?php foreach ($vacancyOrders as $item) :?>
        <div class="col-md-12 bg-dark rounded">
            <p>
                <?=$item->worker->firstname.' '. $item->worker->lastname?>
            </p>

            <p>
                <a href="/download/cv/cv-download1.pdf" target="_blank"><?=Yii::t('app','Show Cv')?></a>
            </p>
            <i><?=$item->created_at?></i>
        </div>


    <?php endforeach;?>

    </div>
<?php ActiveForm::end(); ?>
