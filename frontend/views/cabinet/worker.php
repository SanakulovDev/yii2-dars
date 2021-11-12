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
<?php if($worker->apply_messages > 0) :?>
<audio id="myAudio" autoplay>
    <source src="/frontend/web/notification3.mp3" type="audio/mp3">
</audio>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <?=Yii::t('app','You have received messages')?>
    <a href="/cabinet/worker-order/" class="alert-link"><span
                class="badge badge-primary"><?= $worker->apply_messages ?></span></a>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php endif;?>
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
            'value' => $worker !==null?$worker->region->$langTolower:Yii::t('app','Not included')
        ],
        [
            'attribute' => 'cityId',
            'label' => Yii::t('app', 'City'),
            'value' => $worker !==null?$worker->city->$langTolower:Yii::t('app','Not included')
        ],
        'address',
        'phone',
        [
            'attribute' => 'gender',
            'value' => $worker!==null?$worker->genders->$lang:Yii::t('app','Not included')
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
            'value' => $worker!==null?$worker->professions->$lang:Yii::t('app','Not included')
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
