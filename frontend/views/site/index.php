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
        height: 700px;
        width: 1000px;
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
                            <div class="dropdown bootstrap-select" style="width: 100%;">
                                <select class="selectpicker"
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
                        <?= Html::img("$item->image?/uploads/company/$item->image: https://previews.123rf.com/images/arcady31/arcady311509/arcady31150900028/46164370-job-vacancy-rubber-stamp.jpg", ['class' => 'img-fluid', 'alt' => 'Image']) ?>
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

    var data = [{
        "hc-key": "uz-qr",
        "value": 10,
        "resume_value": <?= \frontend\models\Report::resumeMapJoin(10)[0]['count(*)']?>,
        "company_value": <?= \frontend\models\Report::companyMapJoin(10)[0]['count(*)']?>,
        "vacancy_value": <?= \frontend\models\Report::vacancyMapJoin(10)[0]['count(*)']?>
    }, {
        "hc-key": "uz-bu",
        "value": 6,
        "resume_value": <?= \frontend\models\Report::resumeMapJoin(6)[0]['count(*)']?>,
        "company_value": <?= \frontend\models\Report::companyMapJoin(6)[0]['count(*)']?>,
        "vacancy_value": <?= \frontend\models\Report::vacancyMapJoin(6)[0]['count(*)']?>
    }, {
        "hc-key": "uz-sa",
        "value": 7,
        "resume_value": <?= \frontend\models\Report::resumeMapJoin(7)[0]['count(*)']?>,
        "company_value": <?= \frontend\models\Report::companyMapJoin(7)[0]['count(*)']?>,
        "vacancy_value": <?= \frontend\models\Report::vacancyMapJoin(7)[0]['count(*)']?>
    }, {
        "hc-key": "uz-nw",
        "value": 9,
        "resume_value": <?= \frontend\models\Report::resumeMapJoin(9)[0]['count(*)']?>,
        "company_value": <?= \frontend\models\Report::companyMapJoin(9)[0]['count(*)']?>,
        "vacancy_value": <?= \frontend\models\Report::vacancyMapJoin(9)[0]['count(*)']?>
    }, {
        "hc-key": "uz-an",
        "value": 1,
        "resume_value": <?= \frontend\models\Report::resumeMapJoin(1)[0]['count(*)']?>,
        "company_value": <?= \frontend\models\Report::companyMapJoin(1)[0]['count(*)']?>,
        "vacancy_value": <?= \frontend\models\Report::vacancyMapJoin(1)[0]['count(*)']?>
    }, {
        "hc-key": "uz-fa",
        "value": 14,
        "resume_value": <?= \frontend\models\Report::resumeMapJoin(14)[0]['count(*)']?>,
        "company_value": <?= \frontend\models\Report::companyMapJoin(14)[0]['count(*)']?>,
        "vacancy_value": <?= \frontend\models\Report::vacancyMapJoin(14)[0]['count(*)']?>
    }, {
        "hc-key": "uz-su",
        "value": 12,
        "resume_value": <?= \frontend\models\Report::resumeMapJoin(12)[0]['count(*)']?>,
        "company_value": <?= \frontend\models\Report::companyMapJoin(12)[0]['count(*)']?>,
        "vacancy_value": <?= \frontend\models\Report::vacancyMapJoin(12)[0]['count(*)']?>
    }, {
        "hc-key": "uz-si",
        "value": 11,
        "resume_value": <?= \frontend\models\Report::resumeMapJoin(11)[0]['count(*)']?>,
        "company_value": <?= \frontend\models\Report::companyMapJoin(11)[0]['count(*)']?>,
        "vacancy_value": <?= \frontend\models\Report::vacancyMapJoin(11)[0]['count(*)']?>
    }, {
        "hc-key": "uz-kh",
        "value": 3,
        "resume_value": <?= \frontend\models\Report::resumeMapJoin(3)[0]['count(*)']?>,
        "company_value": <?= \frontend\models\Report::companyMapJoin(3)[0]['count(*)']?>,
        "vacancy_value": <?= \frontend\models\Report::vacancyMapJoin(3)[0]['count(*)']?>
    }, {
        "hc-key": "uz-ta",
        "value": 5,
        "resume_value": <?= \frontend\models\Report::resumeMapJoin(5)[0]['count(*)']?>,
        "company_value": <?= \frontend\models\Report::companyMapJoin(5)[0]['count(*)']?>,
        "vacancy_value": <?= \frontend\models\Report::vacancyMapJoin(5)[0]['count(*)']?>
    }, {
        "hc-key": "uz-qa",
        "value": 13,
        "resume_value": <?= \frontend\models\Report::resumeMapJoin(13)[0]['count(*)']?>,
        "company_value": <?= \frontend\models\Report::companyMapJoin(13)[0]['count(*)']?>,
        "vacancy_value": <?= \frontend\models\Report::vacancyMapJoin(13)[0]['count(*)']?>
    }, {
        "hc-key": "uz-ji",
        "value": 8,
        "resume_value": <?= \frontend\models\Report::resumeMapJoin(8)[0]['count(*)']?>,
        "company_value": <?= \frontend\models\Report::companyMapJoin(8)[0]['count(*)']?>,
        "vacancy_value": <?= \frontend\models\Report::vacancyMapJoin(8)[0]['count(*)']?>
    }, {
        "hc-key": "uz-ng",
        "value": 2,
        "resume_value": <?= \frontend\models\Report::resumeMapJoin(2)[0]['count(*)']?>,
        "company_value": <?= \frontend\models\Report::companyMapJoin(2)[0]['count(*)']?>,
        "vacancy_value": <?= \frontend\models\Report::vacancyMapJoin(2)[0]['count(*)']?>
    }, {
        "hc-key": "uz-tk",
        "value": 4,
        "resume_value": <?= \frontend\models\Report::resumeMapJoin(4)[0]['count(*)']?>,
        "company_value": <?= \frontend\models\Report::companyMapJoin(4)[0]['count(*)']?>,
        "vacancy_value": <?= \frontend\models\Report::vacancyMapJoin(4)[0]['count(*)']?>
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




