<?php
use yii\helpers\Html;
/*
 *
 * $vacancy frontend/models/Vacancy
 */
?>
<section class="site-section" id="next">
    <div class="container">

        <div class="row mb-5 justify-content-center">
            <div class="col-md-7 text-center">
                <h2 class="section-title mb-2"><?=Yii::t('app','43,167 Job Listed')?></h2>
            </div>
        </div>

        <ul class="job-listings mb-5">
            <?php foreach ($vacancy as $key => $item): ?>
                <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
                    <?= Html::a(Yii::t('app', ''), ['vacancy-views', 'id' => $item->id]) ?>
                    <div class="job-listing-logo">
                        <img src="/uploads/vacancy/<?=$item->image?>" alt="Image" class="img-fluid">
                    </div>

                    <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between mx-4">
                        <div class="job-listing-position custom-width w-50 mb-3 mb-sm-0">
                            <h2><?=$item->profession->name_en?></h2>
                            <strong><?=$item->company->name?></strong>
                            <br>
                            <i class="far fa-eye"></i>
                            <strong><?=$item->views?></strong>
                        </div>
                        <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                            <span class="icon-room"></span> <?=$item->address?>
                        </div>
                        <div class="job-listing-meta">
                            <span class="badge badge-danger"><?=$item->jobType->name_en?></span>
                        </div>
                    </div>
                </li>
            <?php endforeach ?>







        </ul>

        <div class="row pagination-wrap">
            <div class="col-md-6 text-center text-md-left mb-4 mb-md-0">
                <span>Showing 1-7 Of 43,167 Jobs</span>
            </div>
            <div class="col-md-6 text-center text-md-right">
                <div class="custom-pagination ml-auto">
                    <a href="#" class="prev">Prev</a>
                    <div class="d-inline-block">
                        <a href="#" class="active">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#">4</a>
                    </div>
                    <a href="#" class="next">Next</a>
                </div>
            </div>
        </div>

    </div>
</section>