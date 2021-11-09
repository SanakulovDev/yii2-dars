<?php

use yii\helpers\Html;

?>
<h1><?= Yii::t('app', ucfirst(Yii::$app->user->identity->username) . " " . Yii::t('app', ' personal information')) ?></h1>
<?php
/**
 *
 * @var \frontend\models\Worker $worker
 * @var \frontend\models\LaborActivity $laborActivity
 * @var \frontend\models\WorkerLanguage $workerLanguage
 */
$lang = 'name_' . Yii::$app->language;
$langTolower = 'name' . ucfirst(Yii::$app->language);?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    Sizga xabar keldi <a href="/cabinet/worker-order/" class="alert-link"><span
                class="badge badge-primary"><?= $worker->apply_messages ?></span></a>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php
echo \yii\widgets\DetailView::widget([
    'model' => $worker,
    'attributes' => [
        'firstname',
        'lastname',
        'patronymic',
        'birthdate',
        [
            'attribute' => 'regionId',
            'label' => Yii::t('app', 'Region'),
            'value' => $worker->region->$langTolower
        ],
        [
            'attribute' => 'cityId',
            'label' => Yii::t('app', 'City'),
            'value' => $worker->city->$langTolower
        ],
        'address',
        'phone',
        [
            'attribute' => 'gender',
            'value' => $worker->genders->$lang
        ],
        'nationality_id',
        [
            'attribute' => 'photo',
            'value' => '@web/uploads/user/' . $worker->photo,
            'format' => ['image', ['width' => '150', 'height' => '150']]
        ],
        'hobby',
        [
            'attribute' => 'profession_id',
            'value' => $worker->professions->$lang
        ],
        [
            'label' => 'Languages',
            'value' => function($worker) use ($lang){
                $know_langs = '';
                if($worker->workerLanguages) {
                    foreach ($worker->workerLanguages as $worker_lang){
                        $temp = $worker_lang->languages ? $worker_lang->languages->$lang . ' ' . $worker_lang->rate . ', ' : ' ';
                        $know_langs .= $temp . ' ';
                    }
                }
                return $know_langs;
            }
        ],
        [
            'label' => 'Labor Activity',
            'value' => function($worker) use ($lang){
                $know_labor_activity = '';
                if($worker->laborActivity) {
                    foreach ($worker->laborActivity as $worker_labor_activity){
                        $temp = $worker_labor_activity ? $worker_labor_activity->company_name . ' korxonasida ' . $worker_labor_activity->position . ' lavozimida ' . $worker_labor_activity->form_date . ' dan ' . $worker_labor_activity->to_date . ' gacha ' : ' ' ;
                        $know_labor_activity .= $temp . ' ';
                    }
                }
                return $know_labor_activity;
            }
        ],
    ],
]);
?>
<?= Html::a(Yii::t('app', 'Edit'), '/cabinet/worker-edit', ['class' => 'btn btn-success']) ?>
