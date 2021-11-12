<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\VacancySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model \frontend\models\Vacancy */

$this->title = Yii::t('app', 'Vacancies');
$this->params['breadcrumbs'][] = $this->title;
$name = 'name_'.Yii::$app->language;
$name_two = 'name' . ucfirst(Yii::$app->language);
?>
<div class="vacancy-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Vacancy'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <div class="row">
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th><?= Yii::t('app', 'Username') ?></th>
                <th><?= Yii::t('app', 'Company name') ?></th>
                <th><?= Yii::t('app', 'Profession name') ?></th>
                <th><?= Yii::t('app', 'Region') ?></th>
                <th><?= Yii::t('app', 'City') ?></th>
                <th><?= Yii::t('app', 'Address') ?></th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($model as $item): ?>
            <tr>
                <td><?= $item->user->username?></td>
                <td><?= $item->company->name?></td>
                <td><?= $item->profession->$name?></td>
                <td><?= $item->region->$name_two?></td>
                <td><?= $item->city->$name_two?></td>
                <td><?= $item->address?></td>
                <td>
                    <a href="view?id=<?=$item->id?>"><span class="icon-eye"></span></a>
                    <a href="update?id=<?=$item->id?>"><span class="icon-pen"></span></a>
                    <a href="delete?id=<?=$item->id?>"><span class="icon-trash"></span></a>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    </div>
    <?php Pjax::end(); ?>

</div>
