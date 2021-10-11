<h1><?= Yii::t('app',ucfirst(Yii::$app->user->identity->username)." ".Yii::t('app',' personal information'))?></h1>
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
            'value' => $worker->region->nameEn
        ],
        [
            'attribute' => 'cityId',
            'label' => Yii::t('app', 'City / District'),
            'value' => $worker->city->nameEn
        ],
        'address',
        'phone',
        'gender',
        'nationality_id',
        [
            'attribute' => 'photo',
            'value' => '@web/uploads/user/' . $worker->photo,
            'format' => ['image', ['width' => '150', 'height' => '150']]
        ],

    ],
]);

?>
<?= \yii\helpers\Html::a(Yii::t('app', 'Edit'), '/cabinet/worker-edit', ['class' => 'btn btn-success']) ?>
