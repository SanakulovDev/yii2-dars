<?php

Qrcode::png("Hello world","qrcode1.png");


echo \yii\widgets\DetailView::widget([
    'model' => $company,
    'attributes' => [
        'name',
        'director_name',
        [
            'attribute' => 'regionId',
            'label' => Yii::t('app', 'Region'),
            'value' => $company->region->nameEn
        ],
        [
            'attribute' => 'cityId',
            'label' => Yii::t('app', 'City / District'),
            'value' => $company->city->nameEn
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

