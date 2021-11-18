<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
//        "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js",
        "https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js",

        "/jobboard/js/bootstrap.bundle.min.js",
        "/jobboard/js/isotope.pkgd.min.js",
        "/jobboard/js/stickyfill.min.js",
        "/jobboard/js/jquery.fancybox.min.js",
        "/jobboard/js/jquery.easing.1.3.js",

        "/jobboard/js/jquery.waypoints.min.js",
        "/jobboard/js/jquery.animateNumber.min.js",
        "/jobboard/js/owl.carousel.min.js",

        "/jobboard/js/bootstrap-select.min.js",

        "/jobboard/js/custom.js",
        'js/main.js',
        'js/map.js',


    ];
    public $css = [
        "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css",
        'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css',
        "/jobboard/css/custom-bs.css",
        "/jobboard/css/jquery.fancybox.min.css",
        "/jobboard/css/bootstrap-select.min.css",
        "/jobboard/fonts/icomoon/style.css",
        "/jobboard/fonts/line-icons/style.css",
        "/jobboard/css/owl.carousel.min.css",
        "/jobboard/css/animate.min.css",
        "/jobboard/css/style.css",
        "css/header.css"
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
