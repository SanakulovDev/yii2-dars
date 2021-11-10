<?php

use mdm\admin\components\Helper;
use mdm\admin\components\MenuHelper;
use yii\bootstrap4\Nav;
use yii\helpers\Html;
use frontend\models\SignupForm;
/**
 * @var $company \frontend\models\Company
 */
?>
<div class="col-md-3 text-end">

    <?php


$menuItems = [
    [
        'label' => 'Logout (' . \Yii::$app->user->identity->username . ')',
        'url' => ['/site/logout'],
        'linkOptions' => ['data-method' => 'post']
    ]
];

$menuItems = array_merge(
    MenuHelper::getAssignedMenu(Yii::$app->user->id),
    Helper::filter($menuItems)
);

echo Nav::widget([
    'items' => $menuItems, // MenuHelper::getAssignedMenu(Yii::$app->user->id),
    'options' => ['class' =>'nav-pills flex-column'],
]);
?>

</div>