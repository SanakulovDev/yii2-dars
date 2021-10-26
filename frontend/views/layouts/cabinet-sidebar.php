<?php

use yii\bootstrap4\Nav;
use yii\helpers\Html;
use frontend\models\SignupForm;
/*
 * $company  frontend/models/Company
 */
?>
<div class="col-md-4" style="text-align: center;">
    <nav class="navbar">
        <ul class="navbar-nav">
            <li class="nav-item"><?=Html::a(Yii::t('app','Home'),'/site/index',['class'=>'nav-link'])?></li>
            <li class="nav-item"><?=Html::a(Yii::t('app','Update Company'),'/site/edit',['class'=>'nav-link'])?></li>
            <li class="nav-item"><?=Html::a(Yii::t('app','Create Worker'),'/site/worker-create',['class'=>'nav-link'])?></li>
            <li class="nav-item"><a href="/vacancy/index" class="nav-link"><?=Yii::t('app','View Vacancies')?></a></li>
            <li class="nav-item"><a href="/vacancy/create" class="nav-link"><?=Yii::t('app','Add Vacancies')?></a></li>

        </ul>
    </nav>
    <?php
    if (!Yii::$app->user->isGuest) {
        $menuItems[] = '<li class="nav-item">'
            . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
            . Html::submitButton(
                Yii::t('app','Logout (') . Yii::$app->user->identity->username . ')',
                ['class' => 'nav-item-link btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'items' => $menuItems,
    ]);
    ?>

</div>