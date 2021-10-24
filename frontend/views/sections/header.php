<?php

use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Html;

?>

<div class="header-blue p-0">
    <nav class="navbar navbar-dark navbar-expand-md navigation-clean-search">
        <div class="container-fluid"><a class="navbar-brand" href="/site/index"><?= Yii::t('app', 'Jobboard') ?></a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span
                        class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse"
                 id="navcol-1">
                <ul class="nav navbar-nav mr-auto">
                    <li class="nav-item " role="presentation"><a href="/site/index"
                                                                class="nav-link  active"><?= Yii::t('app', 'Home') ?></a>
                    </li>
                    <li class="nav-item " role="presentation"><a href="/site/about"
                                                                class="nav-link "><?= Yii::t('app', 'About') ?></a></li>
                    <li class="nav-item " role="presentation"><a href="/site/contact"
                                                                class="nav-link "><?= Yii::t('app', 'Contact') ?></a>
                    </li>
                    <li class="nav-item " role="presentation"><a href="/site/vacancy-view-all"
                                                                class="nav-link "><?= Yii::t('app', 'Vacancy views') ?></a>
                    </li>
                </ul>
                <a href="/vacancy/create" class="btn btn-outline-white border-width-2 d-none d-lg-inline-block m-1"><span
                            class="mr-2 icon-add"></span>Post a Job</a>
                <?php
                if (Yii::$app->user->isGuest) {
                    $menuItems[] = ['label' => Yii::t('app', 'Login'), 'url' => ['/site/login'], 'options' => ['class' => 'btn btn-outline-warning p-0']];
                } else {
                    $menuItems[] = '<li>'
                        . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline m-1'])
                        . Html::a(Yii::t('app', 'Cabinet'), '/cabinet/index', ['class' => 'm-1 btn btn-link'])

                        . Html::submitButton(
                            'Logout (' . Yii::$app->user->identity->username . ')',
                            ['class' => 'btn btn-link m-1 logout']
                        ) . Html::endForm()
                        . '</li>';
                }
                echo Nav::widget([
                    'items' => $menuItems,
                    'options'=>[ 'class'=>'m-1 ']
                ]);
                ?>
            <?= \lajax\languagepicker\widgets\LanguagePicker::widget([
                'itemTemplate' => '<li class="dropdown-item"><a href="{link}"  title="{language}"><i id="{language}"></i> {name}</a></li>',
                'activeItemTemplate' => '<button data-toggle="dropdown" class="btn btn-outline-white border-width-2 d-none d-lg-inline-block dropdown-toggle bg-danger" title="{language}"><i id="{language}"></i> {name}</button>',
                'parentTemplate' => '<div class="language-picker m-1 dropdown-list {size}"><div>{activeItem}<ul class="dropdown-menu">{items}</ul></div></div>',
                'languageAsset' => 'lajax\languagepicker\bundles\LanguageLargeIconsAsset',      // StyleSheets
                'languagePluginAsset' => 'lajax\languagepicker\bundles\LanguagePluginAsset',    // JavaScripts
            ]); ?>
        </div>
    </nav>
</div>

<section class="section-hero pt-0 overlay inner-page bg-image" style="background-image: url('/jobboard/images/hero_1.jpg');"
         id="home-section">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <h1 class="text-white font-weight-bold">About Us</h1>
                <div class="custom-breadcrumbs">
                    <a href="#">Home</a> <span class="mx-2 slash">/</span>
                    <span class="text-white"><strong>About Us</strong></span>
                </div>
            </div>
        </div>
    </div>
</section>






