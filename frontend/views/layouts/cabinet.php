<?php

use frontend\assets\AppAsset;
use yii\bootstrap4\Nav;
use yii\helpers\Html;

AppAsset::register($this);


?>
<?php $this->beginPage() ?>
    <!doctype html>
    <html lang="en">
    <head>
        <title>JobBoard &mdash; <?= Yii::t('app', 'Website Template by Colorlib') ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php
        $this->registerCsrfMetaTags()
        ?>
        <?php
        $this->head()
        ?>
        <link rel="shortcut icon" href="ftco-32x32.png">

    </head>
    <?php $this->beginBody() ?>
    <body class="top">
    <!--<div id="overlayer"></div>-->
    <!--<div class="loader">-->
    <!--    <div class="spinner-border text-primary" role="status">-->
    <!--        <span class="sr-only">Loading...</span>-->
    <!--    </div>-->
    <!--</div>-->
    <div class="site-wrap">

        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div> <!-- .site-mobile-menu -->

        <?= Yii::$app->controller->renderPartial("//sections/header") ?>

        <div class="container">
            <div class="row my-5">
                <?= Yii::$app->controller->renderPartial("/layouts/cabinet-sidebar") ?>


                <div class="col-md-9">
                    <?= $content; ?>

                </div>
            </div>

        </div>


    </div>
    </body>
    <?php $this->endBody() ?>
    <script>

    </script>
    </html>
<?php $this->endPage();