<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;

/**
 *
 * @var $vacancy \frontend\models\Vacancy
 * @var $searchModel \frontend\models\VacancySearch
 * @var $dataProvider \yii\data\ActiveDataProvider
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
                <?php if (empty($dataProvider)): ?>
                    <h2 class="section-title mb-2"><?= 0 . ' ta ' . Yii::t('app', 'Job Listed') ?></h2>
                <?php else : ?>
                    <h2 class="section-title mb-2"><?= $dataProvider->count . ' ' . Yii::t('app', 'Job Listed') ?></h2>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?php echo $this->render('_vacancy-search', ['model' => $searchModel]) ?>
            </div>
            <div class="col-md-8">


                <ul class="job-listings mb-5">
                    <?php foreach ($dataProvider->models as $key => $item): ?>
                        <?php if (empty($item)): ?>
                            <h5><?= Yii::t('app', 'Not found Vacancy') ?></h5>
                        <?php endif ?>
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