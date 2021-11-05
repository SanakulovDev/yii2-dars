<?php

use yii\helpers\Html;
$lang = 'name_'.Yii::$app->language;
$langTolower = 'name'.ucfirst(Yii::$app->language);
?>
<h2><?=ucfirst($company->name).'  '.Yii::t('app','Company informations')?></h2>
<?= \yii\widgets\DetailView::widget([
    'model' => $company,
    'attributes' => [
        'name',
        'director_name',
        [
            'attribute' => 'regionId',
            'label' => Yii::t('app', 'Region'),
            'value' => $company->region->$langTolower
        ],
        [
            'attribute' => 'cityId',
            'label' => Yii::t('app', 'City'),
            'value' => $company->city->$langTolower
        ],

        'address',
        'phone',
        [
            'attribute' => 'image',
            'value' => '@web/uploads/company/' . $company->logo,
            'format' => ['image', ['width' => '150', 'height' => '150']]
        ],
    ],
]);
?>
 <?= Html::a(Yii::t('app', 'Edit'), '/cabinet/edit', ['class' => 'btn btn-success'])?>

