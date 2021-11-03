<h1><?= Yii::t('app', ucfirst(Yii::$app->user->identity->username) . " " . Yii::t('app', ' personal information')) ?></h1>
<?php
/**
 *
 * @var \frontend\models\Worker $worker
 * @var \frontend\models\LaborActivity $laborActivity
 * @var \frontend\models\WorkerLanguage $workerLanguage
 */
$lang = 'name_' . Yii::$app->language;
$langTolower = 'name' . ucfirst(Yii::$app->language);
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
        ]

    ],
]);

?>
<h1>Labor Activity</h1>
<?php
echo \yii\widgets\DetailView::widget([
    'model' => $laborActivity,
    'attributes' => [
        'company_name',
        'position',
        'form_date',
        'to_date'
    ],
]);
?>
<h1>Worker Language</h1>
<?php
echo \yii\widgets\DetailView::widget([
    'model' => $workerLanguage,
    'attributes' => [
        'name_uz',
        'name_en',
        'name_ru',
        'name_cyrl'
    ],
]);
?>
<?= \yii\helpers\Html::a(Yii::t('app', 'Edit'), '/cabinet/worker-edit', ['class' => 'btn btn-success']) ?>
