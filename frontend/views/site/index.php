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
<section class="site-section py-4">
    <div class="container">

        <div class="row align-items-center">
            <div class="col-12 text-center mt-4 mb-5">
                <div class="row justify-content-center">
                    <div class="col-md-7">
                        <h2 class="section-title mb-2"><?= Yii::t('app','Partners')?></h2>


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
                            data-number=<?php echo $job_stats!==null? $job_stats->company_number : 0 ?>><?php echo $job_stats!==null?$job_stats->company_number : 0 ?></strong>
                </div>
                <span class="caption"><?= Yii::t('app', 'Company  count') ?></span>
            </div>

            <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
                <div class="d-flex align-items-center justify-content-center mb-2">
                    <strong class="number"
                            data-number=<?= $job_stats !== null? $job_stats->job_post_number: 0 ?>><?= $job_stats !== null? $job_stats->job_post_number:0 ?></strong>
                </div>
                <span class="caption"><?= Yii::t('app', 'Vacancies') ?></span>
            </div>

            <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
                <div class="d-flex align-items-center justify-content-center mb-2">
                    <strong class="number"
                            data-number=<?= $job_stats !== null? $job_stats->user_number:0 ?>><?= $job_stats !== null? $job_stats->user_number:0 ?></strong>
                </div>
                <span class="caption"><?= Yii::t('app', 'User count') ?></span>
            </div>
            <div class="col-6 col-md-6 col-lg-3 mb-5 mb-lg-0">
                <div class="d-flex align-items-center justify-content-center mb-2">
                    <strong class="number"
                            data-number=<?= $job_stats !== null? $job_stats->cv_count:0 ?>><?= $job_stats !== null? $job_stats->cv_count:0 ?></strong>
                </div>
                <span class="caption"><?= Yii::t('app', 'Workers') ?></span>
            </div>


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
                    <a href="vacancy-views?id=<?= $item->id ?>&get=false"></a>
                    <div class="job-listing-logo">
                        <?= Html::img("/uploads/vacancy/$item->image", ['class' => 'img-fluid', 'alt' => 'Image']) ?>
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
                <button id="vacancy-show-more" class="btn"><?= Yii::t('app', 'Show more') ?></button>
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

