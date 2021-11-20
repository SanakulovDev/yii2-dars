<?php

use frontend\models\VacancyOrders;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;

/**
 * @var \frontend\models\VacancyOrders $v_order
 * @var \frontend\models\Vacancy $vacancy
 * @var \frontend\models\Vacancy $vacancyx
 * @var yii\data\Pagination $pages
 */


$lang = 'name_' . Yii::$app->language;
$langTolower = 'name' . ucfirst(Yii::$app->language);
?>
<section class="site-section">
    <div class="container">
        <?php
        echo Breadcrumbs::widget([
            'itemTemplate' => "<li>{link}</li>\n",
            'links' => [
                [
                    'label' => '/' . Yii::t('app', 'Vacancy views') . '/',
                    'url' => ['site/vacancy-view-all'],
                ],
                Yii::t('app', 'Vacancy views')
            ],
        ]);
        ?>
        <?php if (Yii::$app->session->hasFlash('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?= Yii::$app->session->getFlash('success') ?>
            </div>
        <?php endif; ?>
        <?php if (Yii::$app->session->hasFlash('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?= Yii::$app->session->getFlash('error') ?>
            </div>
        <?php endif; ?>
        <div class="row align-items-center mb-5">

            <div class="col-lg-8 mb-4 mb-lg-0">
                <div class="d-flex align-items-center">
                    <div class=" p-2 d-inline-block mr-3 " style="width: 150px">
                        <?= Html::img("/uploads/vacancy/$vacancy->image", ['class' => 'img-fluid ']) ?>
                    </div>
                    <div>
                        <h2><?= $vacancy->profession->$lang ?></h2>
                        <div>
                            <span class="ml-0 mr-2 mb-2"><span
                                        class="icon-briefcase mr-2"></span><?= $vacancy->company->name ?></span>
                            <span class="m-2"><span class="icon-room mr-2"></span><?= $vacancy->address ?></span>
                            <span class="m-2"><span class="icon-clock-o mr-2"></span><span
                                        class="text-primary"><?= $vacancy->jobType->$lang ?></span></span>
                            <span class="m-2"><span class="mr-2"><i
                                            class="far fa-eye"></i> <?= $vacancy->views ?></span></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="row">

                    <div class="col-10">
                        <?php if (!empty($v_order->status)) : ?>
                            <a href="#"
                               class="btn fs-4 btn-block disabled   btn-success btn-lg">
                                <?php if ($v_order->status == 0): ?>
                                    <span class="icon-spinner"></span>
                                <?php elseif ($v_order->status == 1): ?>
                                    <span class="icon-exclamation-triangle"></span>
                                <?php elseif ($v_order->status == 2): ?>
                                    <span class="icon-check-circle"></span>
                                <?php elseif ($v_order->status == 3): ?>
                                    <span class="icon-check"></span>
                                <?php endif; ?>
                                <?= VacancyOrders::STATUSLIST[$v_order->status]?>
                            </a>
                        <?php else : ?>
                            <?= Html::a('Apply now', '/site/vacancy-views?id=' . $vacancy->id . '&get=true', ['class' => 'btn btn-block btn-primary btn-md']); ?>

                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="mb-5">

                    <h3 class="h5 d-flex align-items-center mb-4 text-primary">
                        <span class="icon-align-left mr-3"></span><?= Yii::t('app', 'Job Description') ?>
                    </h3>
                    <?php
                    $description = 'description_' . Yii::$app->language;
                    ?>
                    <p><?= $vacancy->$description ?></p>
                </div>


                <div class="row mb-5">
                    <div class="col-6">
                        <a href="#" class="btn btn-block btn-light btn-md"><span
                                    class="icon-heart-o mr-2 text-danger"></span><?= Yii::t('app', 'Save Job') ?></a>
                    </div>
                    <div class="col-6">
                        <?php if (!empty($v_order->status)) : ?>
                            <a href="#"
                               class="btn fs-4 btn-block btn-success disabled btn-lg">
                                <?php if ($v_order->status == 0): ?>
                                    <span class="icon-spinner"></span>
                                <?php elseif ($v_order->status == 1): ?>
                                    <span class="icon-exclamation-triangle"></span>
                                <?php elseif ($v_order->status == 2): ?>
                                    <span class="icon-check-circle"></span>
                                <?php elseif ($v_order->status == 3): ?>
                                    <span class="icon-check"></span>
                                <?php endif; ?>
                                <?= VacancyOrders::STATUSLIST[$v_order->status]?>
                            </a>
                        <?php else : ?>
                            <?= Html::a('Apply now', '/site/vacancy-views?id=' . $vacancy->id . '&get=true', ['class' => 'btn btn-block btn-primary btn-md']); ?>

                        <?php endif ?>
                    </div>
                </div>

            </div>
            <div class="col-lg-4">
                <div class="bg-light p-3 border rounded mb-4">
                    <h3 class="text-primary  mt-3 h5 pl-3 mb-3 "><?= Yii::t('app', 'Job Summary') ?></h3>
                    <ul class="list-unstyled pl-3 mb-0">
                        <li class="mb-2"><strong
                                    class="text-black"><?= Yii::t('app', 'Published on') . ': ' ?></strong> <?=  $vacancy->created_at ?>
                        </li>
                        <li class="mb-2"><strong
                                    class="text-black"><?= Yii::t('app', 'Vacancy:') ?></strong> <?= $vacancy->count ?>
                        </li>
                        <li class="mb-2"><strong
                                    class="text-black"><?= Yii::t('app', 'Employment / Status:') ?></strong><?= $vacancy->jobType->$lang ?>
                        </li>
                        <li class="mb-2"><strong
                                    class="text-black"><?= Yii::t('app', 'Experience') . ':  ' ?></strong> <?= $vacancy->experience ?>
                        </li>
                        <li class="mb-2"><strong
                                    class="text-black"><?= Yii::t('app', 'Job Location:') ?></strong><?= $vacancy->address ?>
                        </li>
                        <li class="mb-2"><strong
                                    class="text-black"><?= Yii::t('app', 'Salary') . ':  ' ?></strong> <?= $vacancy->salary ?>
                        </li>
                        <li class="mb-2"><strong
                                    class="text-black"><?= Yii::t('app', 'Gender') . ':  ' ?></strong> <?= $vacancy->genders->$lang ?>
                        </li>
                        <li class="mb-2"><strong
                                    class="text-black"><?= Yii::t('app', 'Application Deadline:') ?></strong> <?= $vacancy->deadline ?>
                        </li>
                    </ul>
                </div>

                <div class="bg-light p-3 border rounded">
                    <h3 class="text-primary  mt-3 h5 pl-3 mb-3 ">Share</h3>
                    <div class="px-3">
                        <a href="#" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-facebook"></span></a>
                        <a href="#" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-twitter"></span></a>
                        <a href="#" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-linkedin"></span></a>
                        <a href="#" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-pinterest"></span></a>
                        <a href="https://telegram.me/<?= str_replace('@', '', $vacancy->telegram) ?>" target="_blanks"
                           class="pt-3 pb-3 pr-3 pl-0"><span class="icon-telegram"></span></a>
                    </div>
                </div>

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
            <?php foreach ($vacancyx as $key => $item): ?>
                <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
                    <?= Html::a(Yii::t('app', ''), ['vacancy-views', 'id' => $item->id]) ?>
                    <div class="job-listing-logo">
                        <img src="/uploads/vacancy/<?= $item->image ?>" alt="Image" class="img-fluid">
                    </div>

                    <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
                        <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                            <h2><?= $item->profession->$lang ?></h2>
                            <strong><?= $item->company->name ?></strong>
                            <br>
                            <i class="far fa-eye"></i>
                            <strong><?= $item->views ?></strong>
                        </div>
                        <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                            <span class="icon-room"></span> <?= $item->address ?>
                        </div>
                        <div class="job-listing-meta">
                            <span class="badge badge-danger"><?= $item->jobType->$lang ?></span>
                        </div>
                    </div>
                </li>
            <?php endforeach ?>


        </ul>

        <div class="row pagination-wrap">
            <div class="col-md-6 text-center text-md-left mb-4 mb-md-0">
                <span>Showing 1-7 Of <?= $pages->totalCount ?> Jobs</span>
            </div>
            <div class="col-md-6 text-center text-md-right">
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



