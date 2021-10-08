
<!doctype html>
<html lang="en">
<head>
    <title>JobBoard &mdash; <?=Yii::t('app','Website Template by Colorlib')?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="Free-Template.co" />
    <link rel="shortcut icon" href="ftco-32x32.png">
    <!-- CSS only -->

    <link rel="stylesheet" href="/jobboard/css/custom-bs.css">
    <link rel="stylesheet" href="/jobboard/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="/jobboard/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="/jobboard/fonts/icomoon/style.css">
    <link rel="stylesheet" href="/jobboard/fonts/line-icons/style.css">
    <link rel="stylesheet" href="/jobboard/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/jobboard/css/animate.min.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="/jobboard/css/style.css">
</head>
<body id="top">

<div id="overlayer"></div>
<div class="loader">
    <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
<div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
            <div class="site-mobile-menu-close mt-3">
                <span class="icon-close2 js-menu-toggle"></span>
            </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div> <!-- .site-mobile-menu -->

<?= Yii::$app->controller->renderPartial("//sections/header")?>
    <div class="">
        <?= $content;?>
    </div>
<?= Yii::$app->controller->renderPartial("//sections/footer");?>

</div>

<!-- SCRIPTS -->
<!-- JavaScript Bundle with Popper -->
<script src="/jobboard/js/jquery.min.js"></script>
<script src="/jobboard/js/bootstrap.bundle.min.js"></script>
<script src="/jobboard/js/isotope.pkgd.min.js"></script>
<script src="/jobboard/js/stickyfill.min.js"></script>
<script src="/jobboard/js/jquery.fancybox.min.js"></script>
<script src="/jobboard/js/jquery.easing.1.3.js"></script>

<script src="/jobboard/js/jquery.waypoints.min.js"></script>
<script src="/jobboard/js/jquery.animateNumber.min.js"></script>
<script src="/jobboard/js/owl.carousel.min.js"></script>

<script src="/jobboard/js/bootstrap-select.min.js"></script>

<script src="/jobboard/js/custom.js"></script>
<script src="/frontend/web/js/main.js"></script>


</body>
</html>