<?php

use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Html;

?>
<header class="site-navbar " style="top: 0;" >
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="site-logo col-md-3"><a href="/site/index" class="text-black"><?= Yii::t('app', 'Jobboard') ?></a></div>


            <nav class="site-navigation col-md-6 " style="position: relative">
                <ul class="site-menu js-clone-nav d-none d-xl-block ml-0 pl-0 ">
                    <li><a href="/site/index" class="nav-link text-success active"><?= Yii::t('app', 'Home') ?></a></li>
                    <li><a href="/site/about" class="nav-link text-success"><?= Yii::t('app', 'About') ?></a></li>

                    <li><a href="blog.html" class="nav-link text-success"><?= Yii::t('app', 'Blog') ?></a></li>
                    <li><a href="/site/contact" class="nav-link text-success"><?= Yii::t('app', 'Contact') ?></a></li>
                    <li>
                    </li>
                    <li class="d-lg-none"><a href="/site/logout"><?=Yii::t('app','Login')?></a></li>
                </ul>
            </nav>

            <div class="right-cta-menu text-right d-flex aligin-items-center col-md-5" style="z-index: 1000">
                <div class="ml-auto d-flex  align-items-center justify-content-center">
                    <div class="m-1">

                        <?= \lajax\languagepicker\widgets\LanguagePicker::widget([
                            'itemTemplate' => '<li class="dropdown-item"><a href="{link}"  title="{language}"><i id="{language}"></i> {name}</a></li>',
                            'activeItemTemplate' => '<button data-toggle="dropdown" class="btn btn-outline-white border-width-2 d-none d-lg-inline-block dropdown-toggle bg-danger" title="{language}"><i id="{language}"></i> {name}</button>',
                            'parentTemplate' => '<div class="language-picker  dropdown-list {size}"><div>{activeItem}<ul class="dropdown-menu">{items}</ul></div></div>',
                            'languageAsset' => 'lajax\languagepicker\bundles\LanguageLargeIconsAsset',      // StyleSheets
                            'languagePluginAsset' => 'lajax\languagepicker\bundles\LanguagePluginAsset',    // JavaScripts
                        ]); ?>

                    </div>

                    <div class="m-1">
                       <?php
                        if (Yii::$app->user->isGuest) {
                        $menuItems[] = ['label' => Yii::t('app', 'Login'), 'url' => ['/site/login'], 'options'=>['class'=>'btn btn-outline-warning p-0']];
                        $menuItems[] = ['label' => Yii::t('app', 'Signup'), 'url' => ['/site/signup'],'options'=>['class'=>'btn btn-outline-warning p-0']];
                        } else {
                        $menuItems[] = '<li>'
                            . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
                            . Html::submitButton(
                            'Logout (' . Yii::$app->user->identity->username . ')',
                            ['class' => 'btn btn-link logout']
                            )
                            . Html::endForm()
                            . '</li>';
                        }
                       echo Nav::widget([
                           'items' => $menuItems,
                       ]);

                        ?>
                    </div>
                </div>
                <a href="#" class="site-menu-toggle js-menu-toggle d-inline-block d-xl-none mt-lg-2 ml-3"><span
                            class="icon-menu h3 m-0 p-0 mt-2"></span></a>
            </div>
        </div>
    </div>
</header>

<section class="section-hero overlay inner-page bg-image" style="background-image: url('/jobboard/images/hero_1.jpg');" id="home-section">
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



