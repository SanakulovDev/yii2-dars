<?php
use Da\QrCode\QrCode;

$qrCode = (new QrCode('This is my text'))
    ->setSize(250)
    ->setMargin(5)
    ->useForegroundColor(51, 153, 255);

// now we can display the qrcode in many ways
// saving the result to a file:

$qrCode->writeFile(__DIR__ . '/code.png'); // writer defaults to PNG when none is specified

// display directly to the browser
header('Content-Type: '.$qrCode->getContentType());
echo $qrCode->writeString();

// or even as data:uri url
echo '<img src="' . $qrCode->writeDataUri() . '">';
?>

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

