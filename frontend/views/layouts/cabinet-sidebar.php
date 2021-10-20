<?php

use yii\bootstrap4\Nav;
use yii\helpers\Html;
use frontend\models\SignupForm;

?>
<div class="col-md-4" style="text-align: center;">
    <nav class="navbar">
        <ul class="navbar-nav">
            <li class="nav-item"><a href="#" class="nav-link"><?= Yii::t('app','Home')?></a></li>
            <li class="nav-item"><a href="#" class="nav-link"><?= Yii::t('app','About')?></a></li>
            <li class="nav-item"><a href="#" class="nav-link"><?= Yii::t('app','Contact')?></a></li>
            <li class="nav-item"><a href="/vacancy/create" class="nav-link"><?= Yii::t('app','Add  Vacancy')?></a></li>

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