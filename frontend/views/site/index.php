<?php

/* @var $this yii\web\View */
/* @var $query \common\models\Partners */
/* @var $job_stats \frontend\models\JobStats */
/* @var $vacancy \frontend\models\Vacancy */

/* @var $pages \yii\data\Pagination */


use sjaakp\loadmore\LoadMorePager;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;

$lang = 'name_' . Yii::$app->language;
$this->title = 'My Yii Application';

?>
<style>
    #container {
        height: 500px;
        min-width: 310px;
        max-width: 800px;
        margin: 0 auto;
    }

    .loading {
        margin-top: 10em;
        text-align: center;
        color: gray;
    }
</style>
<section class="home-section section-hero overlay bg-image"
         style="background-image: url('/jobboard/images/hero_1.jpg');" id="home-section">

    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-12">
                <div class="mb-5 text-center">
                    <h1 class="text-white font-weight-bold">The Easiest Way To Get Your Dream Job</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate est, consequuntur
                        perferendis.</p>
                </div>
                <form method="post" class="search-jobs-form">
                    <div class="row mb-5">
                        <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                            <input type="text" class="form-control form-control-lg" placeholder="Job title, Company...">
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                            <div class="dropdown bootstrap-select" style="width: 100%;"><select class="selectpicker"
                                                                                                data-style="btn-white btn-lg"
                                                                                                data-width="100%"
                                                                                                data-live-search="true"
                                                                                                title="Select Region"
                                                                                                tabindex="-98">
                                    <option class="bs-title-option" value=""></option>
                                    <option>Anywhere</option>
                                    <option>San Francisco</option>
                                    <option>Palo Alto</option>
                                    <option>New York</option>
                                    <option>Manhattan</option>
                                    <option>Ontario</option>
                                    <option>Toronto</option>
                                    <option>Kansas</option>
                                    <option>Mountain View</option>
                                </select>

                                <div class="dropdown-menu " role="combobox">
                                    <div class="bs-searchbox"><input type="text" class="form-control" autocomplete="off"
                                                                     role="textbox" aria-label="Search"></div>
                                    <div class="inner show" role="listbox" aria-expanded="false" tabindex="-1">
                                        <ul class="dropdown-menu inner show"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                            <div class="dropdown bootstrap-select" style="width: 100%;">
                                <select class="selectpicker" data-style="btn-white btn-lg" data-width="100%"
                                        data-live-search="true" title="Select Job Type" tabindex="-98">
                                    <option class="bs-title-option" value=""></option>
                                    <option>Part Time</option>
                                    <option>Full Time</option>
                                </select>

                                <div class="dropdown-menu " role="combobox">
                                    <div class="bs-searchbox"><input type="text" class="form-control" autocomplete="off"
                                                                     role="textbox" aria-label="Search"></div>
                                    <div class="inner show" role="listbox" aria-expanded="false" tabindex="-1">
                                        <ul class="dropdown-menu inner show"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4 mb-lg-0">
                            <button type="submit" class="btn btn-primary btn-lg btn-block text-white btn-search"><span
                                        class="icon-search icon mr-2"></span>Search Job
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 popular-keywords">
                            <h3>Trending Keywords:</h3>
                            <ul class="keywords list-unstyled m-0 p-0">
                                <li><a href="#" class="">UI Designer</a></li>
                                <li><a href="#" class="">Python</a></li>
                                <li><a href="#" class="">Developer</a></li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <a href="#next" class="scroll-button smoothscroll">
        <span class=" icon-keyboard_arrow_down"></span>
    </a>

</section>

<section class="site-section">
    <div class="container" id="container">

    </div>
</section>

<section class="py-5 bg-image overlay-primary fixed overlay" id="next"
         style="background-image: url('images/hero_1.jpg');">
    <div class="container">
        <div class="row mb-5 justify-content-center">
            <div class="col-md-7 text-center">
                <h2 class="section-title mb-2 text-white"><?= Yii::t('app', 'JobBoard Site Stats') ?></h2>

            </div>
        </div>
        <div class="row pb-0 block__19738 section-counter">


            <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">

                <div class="d-flex align-items-center justify-content-center mb-2">
                    <strong class="number"
                            data-number=<?php echo $job_stats !== null ? $job_stats->company_number : 0 ?>><?php echo $job_stats !== null ? $job_stats->company_number : 0 ?></strong>
                </div>
                <span class="caption"><?= Yii::t('app', 'Company  count') ?></span>
            </div>

            <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
                <div class="d-flex align-items-center justify-content-center mb-2">
                    <strong class="number"
                            data-number=<?= $job_stats !== null ? $job_stats->job_post_number : 0 ?>><?= $job_stats !== null ? $job_stats->job_post_number : 0 ?></strong>
                </div>
                <span class="caption"><?= Yii::t('app', 'Vacancies') ?></span>
            </div>

            <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
                <div class="d-flex align-items-center justify-content-center mb-2">
                    <strong class="number"
                            data-number=<?= $job_stats !== null ? $job_stats->user_number : 0 ?>><?= $job_stats !== null ? $job_stats->user_number : 0 ?></strong>
                </div>
                <span class="caption"><?= Yii::t('app', 'User count') ?></span>
            </div>
            <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
                <div class="d-flex align-items-center justify-content-center mb-2">
                    <strong class="number"
                            data-number=<?= $job_stats !== null ? $job_stats->cv_count : 0 ?>><?= $job_stats !== null ? $job_stats->cv_count : 0 ?></strong>
                </div>
                <span class="caption"><?= Yii::t('app', 'Workers') ?></span>
            </div>


        </div>
    </div>
</section>

<section class="site-section py-4">
    <div class="container">

        <div class="row align-items-center">
            <div class="col-12 text-center mt-4 mb-5">
                <div class="row justify-content-center">
                    <div class="col-md-7">
                        <h2 class="section-title mb-2"><?= Yii::t('app', 'Partners') ?></h2>


                    </div>
                </div>

            </div>
            <?php foreach ($query as $item): ?>
                <div class="col-6 col-lg-3 col-md-6 text-center">
                    <a href="<?= $item->url ?>">
                        <img src="<?= "/uploads/" . $item->logo ?>" alt="Image" class="img-fluid"
                             style="max-width: <?= $item->maxwidth ?>px;">
                    </a>
                </div>

            <?php endforeach ?>
        </div>
    </div>
</section>

<section class="site-section" id="next">
    <div class="container">

        <div class="row mb-5 justify-content-center">
            <div class="col-md-7 text-center">

                <h2 class="section-title mb-2"><?= $pages->totalCount . ' ' . Yii::t('app', 'Job Listed') ?></h2>
            </div>
        </div>

        <ul class="job-listings mb-5">
            <?php foreach ($vacancy as $key => $item): ?>
                <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
                    <a href="/site/vacancy-views?id=<?= $item->id ?>&get=false"></a>
                    <div class="job-listing-logo">
                        <?= Html::img("/uploads/company/$item->image", ['class' => 'img-fluid', 'alt' => 'Image']) ?>
                    </div>

                    <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
                        <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                            <h2><?= $item->profession ? $item->profession->$lang : 'Kiritilmagan' ?></h2>
                            <strong><?= $item->company->name ?></strong>
                            <br>
                            <i class="far fa-eye"></i>
                            <strong><?= $item->views ?></strong>
                        </div>
                        <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                            <span class="icon-room"></span> <?= $item->address ?>
                        </div>
                        <div class="job-listing-meta">
                            <span class="badge badge-danger"><?= $item->jobType ? $item->jobType->$lang : null ?></span>
                        </div>
                    </div>
                </li>
            <?php endforeach ?>


        </ul>

        <div class="row pagination-wrap">
            <div class="col-md-4 text-center text-md-left mb-4 mb-md-0">
                <span>Showing 1-7 Of <?= $pages->totalCount ?> Jobs </span>
            </div>
            <div class="col-md-4">
                <?= Html::a(Yii::t('app', 'Show more'), '/site/vacancy-view-all', ['class' => 'btn btn-info']) ?>
            </div>
            <div class="col-md-4 text-center text-md-right">
                <?= LinkPager::widget([
                    'pagination' => $pages,
                    'options' => ['class' => 'custom-pagination ml-auto d-flex align-items-center justify-content-end nav'],
                    'pageCssClass' => 'mr-2',
                    'prevPageLabel' => Yii::t('app', 'Prev'),
                    'nextPageLabel' => Yii::t('app', 'Next'),
                    'prevPageCssClass' => 'prev ',
                    'nextPageCssClass' => 'next ',
                    'linkOptions' => ['class' => 'prev']
                ]) ?>
            </div>
        </div>


    </div>
</section>


<script src="https://code.highcharts.com/maps/highmaps.js"></script>
<script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
<script src="https://code.highcharts.com/mapdata/countries/uz/uz-all.js"></script>
<script>
    // var data = [
    //     ['uz-fa', 0],
    //     ['uz-tk', 1],
    //     ['uz-an', 2],
    //     ['uz-ng', 3],
    //     ['uz-ji', 4],
    //     ['uz-si', 5],
    //     ['uz-ta', 6],
    //     ['uz-bu', 7],
    //     ['uz-kh', 8],
    //     ['uz-qr', 9],
    //     ['uz-nw', 10],
    //     ['uz-sa', 11],
    //     ['uz-qa', 12],
    //     ['uz-su', 13]
    // ];


    var data = [{
        "hc-key": "uz-qr",
        "value": 800,
        "resume_value": 528,
        "company_value": 2993,
        "vacancy_value": "1451"
    }, {
        "hc-key": "uz-bu",
        "value": 900,
        "resume_value": 418,
        "company_value": 3562,
        "vacancy_value": "4383"
    }, {
        "hc-key": "uz-sa",
        "value": 1000,
        "resume_value": 536,
        "company_value": 4211,
        "vacancy_value": "1767"
    }, {
        "hc-key": "uz-nw",
        "value": 1100,
        "resume_value": 329,
        "company_value": 2212,
        "vacancy_value": "634"
    }, {
        "hc-key": "uz-an",
        "value": 1200,
        "resume_value": 401,
        "company_value": 3866,
        "vacancy_value": "3162"
    }, {
        "hc-key": "uz-fa",
        "value": 1300,
        "resume_value": 438,
        "company_value": 4493,
        "vacancy_value": "3003"
    }, {
        "hc-key": "uz-su",
        "value": 1400,
        "resume_value": 292,
        "company_value": 4041,
        "vacancy_value": "3442"
    }, {
        "hc-key": "uz-si",
        "value": 1500,
        "resume_value": 230,
        "company_value": 1799,
        "vacancy_value": "1607"
    }, {
        "hc-key": "uz-kh",
        "value": 1600,
        "resume_value": 452,
        "company_value": 2769,
        "vacancy_value": "891"
    }, {
        "hc-key": "uz-ta",
        "value": 1700,
        "resume_value": 516,
        "company_value": 4947,
        "vacancy_value": "3208"
    }, {
        "hc-key": "uz-qa",
        "value": 1800,
        "resume_value": 720,
        "company_value": 4311,
        "vacancy_value": "3737"
    }, {
        "hc-key": "uz-ji",
        "value": 1900,
        "resume_value": 251,
        "company_value": 3944,
        "vacancy_value": "2157"
    }, {
        "hc-key": "uz-ng",
        "value": 2100,
        "resume_value": 451,
        "company_value": 3353,
        "vacancy_value": "1989"
    }, {
        "hc-key": "uz-tk",
        "value": 2200,
        "resume_value": 1323,
        "company_value": 10354,
        "vacancy_value": "11047"
    }];

    // Create the chart
    Highcharts.mapChart('container', {
        chart: {
            map: 'countries/uz/uz-all'
        },

        title: {
            text: ''
        },

        subtitle: {
            text: 'Source map: <a href="http://code.highcharts.com/mapdata/countries/uz/uz-all.js">Uzbekistan</a>'
        },

        mapNavigation: {
            enabled: false,
            buttonOptions: {
                verticalAlign: 'bottom'
            }
        },

        colorAxis: {
            min: 0
        },

        series: [{
            data: data,
            mapData: Highcharts.maps['countries/uz/uz-all'],
            joinBy: 'hc-key',
            name: 'Uzbekistan Respublikasi',
            states: {
                hover: {
                    color: '#BADA55'
                }
            },
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            },
            tooltip: {
                headerFormat: '',
                backgroundColor: null,
                borderWidth: 0,
                shadow: false,
                useHTML: true,
                pointFormat: '<p><strong>{point.name}</strong></p><br><p>Иш берувчилар / Работодателей: <span>{point.company_value}</span></p><br><p>Бўш иш ўринлари / Вакансии: <span>{point.vacancy_value}</span></p><br><p>Квоталанган иш ўринлари / Квотируемые рабочие места: <span>{point.quota_value}</span></p><br><p>Резюмелар / Резюме: <span>{point.resume_value}</span></p>'
            }
        }]
    });

</script>



