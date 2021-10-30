<?php

use mdm\admin\components\Helper;
use mdm\admin\components\MenuHelper;
use yii\bootstrap4\Nav;
use yii\helpers\Html;
use frontend\models\SignupForm;
/*
 * $company  frontend/models/Company
 */
?>
<div class="col-md-3" style="text-align: center;">
<!--    <nav class="navbar">-->
<!--        <ul class="navbar-nav">-->
<!--            <li class="nav-item">--><?//=Html::a(Yii::t('app','Home'),'/site/index',['class'=>'nav-link'])?><!--</li>-->
<!--            <li class="nav-item">--><?//=Html::a(Yii::t('app','Update Company'),'/site/edit',['class'=>'nav-link'])?><!--</li>-->
<!--            <li class="nav-item">--><?//=Html::a(Yii::t('app','Create Worker'),'/site/worker-create',['class'=>'nav-link'])?><!--</li>-->
<!--            <li class="nav-item"><a href="/vacancy/index" class="nav-link">--><?//=Yii::t('app','View Vacancies')?><!--</a></li>-->
<!--            <li class="nav-item"><a href="/vacancy/create" class="nav-link">--><?//=Yii::t('app','Add Vacancies')?><!--</a></li>-->
<!---->
<!--        </ul>-->
<!--    </nav>-->
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