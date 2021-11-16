<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;

/**
 *
 * @var $vacancy \frontend\models\Vacancy
 * @var $searchModel \frontend\models\VacancySearch
 */

$lang = 'name_' . Yii::$app->language;
$profession = \common\models\Profession::selectList();
$region = \common\models\Region::selectList();
$job_type = \common\models\JobType::selectList();
$city = [];

//var_dump($dataProvider->models);
//die();
?>
<section class="site-section" id="next">
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
        <div class="row mb-5 justify-content-center">
            <div class="col-md-7 text-center">

                <h2 class="section-title mb-2"><?= $pages->totalCount . ' ' . Yii::t('app', 'Job Listed') ?></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Reset'),'vacancy-view-all', ['class' => 'btn btn-outline-secondary']) ?>
                <?php echo $this->render('_vacancy-search',['model'=>$searchModel])?>
            </div>
            <div class="col-md-8">
                <ul class="job-listings mb-5">
                    <?php foreach ($dataProvider->models as $key => $item): ?>
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
            </div>
        </div>


        <div class="row pagination-wrap">
            <div class="col-md-6 text-center text-md-left mb-4 mb-md-0">
                <span>Showing 1-7 Of <?= $pages->totalCount ?> Jobs </span>
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