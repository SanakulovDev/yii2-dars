<?php

/* @var $this yii\web\View */
/* @var $query \common\models\Partners */
/* @var $job_stats \frontend\models\JobStats */
/* @var $vacancy \frontend\models\Vacancy */
/* @var $trendVacancy \frontend\models\Vacancy */

/* @var $pages \yii\data\Pagination */

/* @var $searchModel \frontend\models\VacancySearch */


use common\widgets\NewsWidget;
use common\widgets\VacancyWidget;
use wbraganca\selectivity\SelectivityWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

$lang = 'name_' . Yii::$app->language;
$langUz = 'name' . ucfirst(Yii::$app->language);
$this->title = 'My Yii Application';
$region_list = \common\models\Region::selectList();
$job_type_list = \common\models\JobType::selectList();
$profession = \common\models\Profession::selectList();
?>
<style>
    #container {
        height: 500px;
        /*width: 1000px;*/
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
                    <h1 class="text-white font-weight-bold"><?= Yii::t('app', 'The Easiest Way To Get Your Dream Job') ?></h1>

                </div>

                <?php $form = ActiveForm::begin([
                    'action' => ['/site/vacancy-view-all'],
                    'method' => 'get',
                    'options' => [
                        'data-pjax' => 1,
                        'enctype' => 'multipart/form-data'
                    ],
                ]); ?>
                <div class="row mb-5 align-items-center justify-content-center">
                    <div class="col-12 col-sm-6 col-md-3 m-0 col-lg-3  mb-lg-0">

                        <select class="form-control m-2 p-2" name="VacancySearch[company_id]" id="select2" data-width="250" data-height="30">
                            <option value="">---</option>
                        </select>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 m-0 col-lg-3  mb-lg-0">
                        <?= $form->field($searchModel, 'profession_id',['options'=>['class'=>'m-0']])->label(false)->widget(SelectivityWidget::classname(), [
                            'pluginOptions' => [
                                'allowClear' => true,
                                'data' => $profession,
                                'placeholder' => Yii::t('app','Select a profession')
                            ]
                        ]) ?>

                    </div>
                    <div class="col-12 col-sm-6 col-md-3 m-0 col-lg-3  mb-lg-0 ">


                        <?= $form->field($searchModel, 'job_type_id',['options'=>['class'=>'m-0']])->label(false)->widget(SelectivityWidget::classname(), [
                            'pluginOptions' => [
                                'allowClear' => true,
                                'data' => $job_type_list,
                                'placeholder' => Yii::t('app','Select the job type')
                            ]
                        ]) ?>

                    </div>


                    <div class="col-12 col-sm-6 col-md-3 col-lg-3  mb-lg-0">
                        <button type="submit" class="btn btn-primary btn-lg btn-block text-white btn-search"><span
                                    class="icon-search icon mr-2"></span><?= Yii::t('app','Search Job')?>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 popular-keywords">
                        <h3><?= Yii::t('app','Trending Keywords:')?></h3>
                        <ul class="keywords list-unstyled m-0 p-0">
                            <?php
//                            vd($trendVacancy);
                            ?>
                            <?php foreach ($trendVacancy as $item):?>

                                <li><a href="#"><?= $item->profession->$lang?></a></li>

                            <?php endforeach;?>
                        </ul>
                    </div>
                </div>
                <?php \yii\widgets\ActiveForm::end() ?>
            </div>
        </div>
    </div>

    <a href="#next" class="scroll-button smoothscroll">
        <span class=" icon-keyboard_arrow_down"></span>
    </a>

</section>
<!--map container sections-->
<section class="site-section">
    <div class="row">
        <div class="col-md-8" id="container">

        </div>
        <div class="col-md-4">
            <?= VacancyWidget::widget(['count' => 3]) ?>
        </div>
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
                        <?php if ($item->image): ?>
                            <?= Html::img("/uploads/company/$item->image", ['class' => 'img-fluid', 'alt' => 'Image']); ?>
                        <?php else: ?>
                            <?= Html::img("https://previews.123rf.com/images/arcady31/arcady311509/arcady31150900028/46164370-job-vacancy-rubber-stamp.jpg", ['class' => 'img-fluid', 'alt' => 'Image']); ?>
                        <?php endif; ?>
                    </div>

                    <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
                        <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                            <h2><?= $item->profession ? $item->profession->$lang : Yii::t('app','Not included')?></h2>
                            <strong><?= $item->company->name ?></strong>
                            <br>
                            <i class="far fa-eye"></i>
                            <strong><?= $item->views?$item->views: 0 ?></strong>
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
                <?php
                $begin = $pages->getPage() * $pages->pageSize + 1;
                $end = $begin + count($vacancy) - 1;
                if ($begin > $end) {
                    $begin = $end;
                }
                $current_page = $pages->getPage();
                $page = $pages->getPage() + 1;
                $pageCount = $pages->pageCount;


                $summary = Yii::t('yii', 'Showing <b>{begin, number}-{end, number}</b> of <b>{totalCount, number}</b> {totalCount, plural, one{item} other{items}}.', [
                    'begin' => $begin,
                    'end' => $end,
                    'count' => $pages->totalCount,
                    'totalCount' => $pages->totalCount,
                    'page' => $page,
                    'pageCount' => $page]);
                ?>
                <span><?= $summary ?></span>

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
<?php
if ($result_maps) {
    $arr = [
        'uz-an',
        'uz-ng',
        'uz-kh',
        'uz-tk',
        'uz-ta',
        'uz-bu',
        'uz-sa',
        'uz-ji',
        'uz-nw',
        'uz-qr',
        'uz-si',
        'uz-su',
        'uz-qa',
        'uz-fa'
    ];

}

?>
<script>

    var data = <?= $result_maps?>

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
                    color: '#ffffff'
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
                pointFormat: '<p><strong>{point.name}</strong></p><br><p>Иш берувчилар / Работодателей: <span>{point.company_value}</span></p><br><p>Бўш иш ўринлари / Вакансии: <span>{point.vacancy_value}</span></p><br><p>Резюмелар / Резюме: <span>{point.resume_value}</span></p>'
            }
        }]
    });

</script>






