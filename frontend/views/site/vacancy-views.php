<?php

use yii\helpers\Html;

?>
<section class="site-section">
    <div class="container">
        <div class="row align-items-center mb-5">

            <div class="col-lg-8 mb-4 mb-lg-0">
                <div class="d-flex align-items-center">
                    <div class=" p-2 d-inline-block mr-3 " style="width: 150px">
                        <?= Html::img("/uploads/vacancy/$vacancy->image", ['class' => 'img-fluid ']) ?>
                    </div>
                    <div>
                        <h2><?= $vacancy->profession->name_en ?></h2>
                        <div>
                            <span class="ml-0 mr-2 mb-2"><span
                                        class="icon-briefcase mr-2"></span><?= $vacancy->company->name ?></span>
                            <span class="m-2"><span class="icon-room mr-2"></span><?= $vacancy->address ?></span>
                            <span class="m-2"><span class="icon-clock-o mr-2"></span><span
                                        class="text-primary"><?= $vacancy->jobType->name_uz ?></span></span>
                            <span class="m-2"><span class="mr-2"><i
                                            class="far fa-eye"></i> <?= $vacancy->views ?></span></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-6">
                        <a href="#" class="btn btn-block btn-light btn-md">
                            <span class="icon-heart-o mr-2 text-danger"></span>
                            <?= Yii::t('app', 'Save Job') ?></a>
                    </div>
                    <div class="col-6">
                        <?=Html::a(Yii::t('app','Apply now'),['apply-vacancy', 'id' => $vacancy->id],['class'=>'btn btn-block btn-primary btn-md'])?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="mb-5">
                    <figure class="mb-5"><img src="/jobboard/images/job_single_img_1.jpg" alt="Image"
                                              class="img-fluid rounded"></figure>
                    <h3 class="h5 d-flex align-items-center mb-4 text-primary"><span
                                class="icon-align-left mr-3"></span>Job Description</h3>
                    <?=$vacancy->description_en?>
                </div>


                <div class="row mb-5">
                    <div class="col-6">
                        <a href="#" class="btn btn-block btn-light btn-md"><span
                                    class="icon-heart-o mr-2 text-danger"></span>Save Job</a>
                    </div>
                    <div class="col-6">
                        <a href="#" class="btn btn-block btn-primary btn-md">Apply Now</a>
                    </div>
                </div>

            </div>
            <div class="col-lg-4">
                <div class="bg-light p-3 border rounded mb-4">
                    <h3 class="text-primary  mt-3 h5 pl-3 mb-3 "><?=Yii::t('app','Job Summary')?></h3>
                    <ul class="list-unstyled pl-3 mb-0">
                        <li class="mb-2"><strong class="text-black"><?=Yii::t('app','Published on:  ')?></strong> <?=date('Y-m-d', $vacancy->created_at)?></li>
                        <li class="mb-2"><strong class="text-black"><?=Yii::t('app','Vacancy:  ')?></strong> <?=$vacancy->count_vacancy?></li>
                        <li class="mb-2"><strong class="text-black"><?=Yii::t('app','Employment:</ Status:  ')?></strong><?=$vacancy->jobType->name_en?></li>
                        <li class="mb-2"><strong class="text-black"><?=Yii::t('app','Experience:  ')?></strong> <?=$vacancy->experience?></li>
                        <li class="mb-2"><strong class="text-black"><?=Yii::t('app','Job Location:  ')?></strong><?=$vacancy->address?></li>
                        <li class="mb-2"><strong class="text-black"><?=Yii::t('app','Salary:  ')?></strong> <?=$vacancy->salary?></li>
                        <li class="mb-2"><strong class="text-black"><?=Yii::t('app','Genderstrong> Any:  ')?></strong> <?=$vacancy->genders->name_en?></li>
                        <li class="mb-2"><strong class="text-black"><?=Yii::t('app','Application Deadline:  ')?></strong> <?=$vacancy->deadline?></li>
                    </ul>
                </div>

                <div class="bg-light p-3 border rounded">
                    <h3 class="text-primary  mt-3 h5 pl-3 mb-3 ">Share</h3>
                    <div class="px-3">
                        <a href="#" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-facebook"></span></a>
                        <a href="#" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-twitter"></span></a>
                        <a href="#" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-linkedin"></span></a>
                        <a href="#" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-pinterest"></span></a>
                        <a href="https://telegram.me/<?=str_replace('@','',$vacancy->telegram)?>" target="_blanks" class="pt-3 pb-3 pr-3 pl-0"><span class="icon-telegram"></span></a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<?php
//var_dump($vacancyx);
//die();
?>
<section class="site-section" id="next">
    <div class="container">

        <div class="row mb-5 justify-content-center">
            <div class="col-md-7 text-center">
                <h2 class="section-title mb-2"><?= Yii::t('app', '43,167 Job Listed') ?></h2>
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
                            <h2><?= $item->profession->name_en ?></h2>
                            <strong><?= $item->company->name ?></strong>
                            <br>
                            <i class="far fa-eye"></i>
                            <strong><?= $item->views ?></strong>
                        </div>
                        <div class="job-listing-location mb-3 mb-sm-0 custom-width w-25">
                            <span class="icon-room"></span> <?= $item->address ?>
                        </div>
                        <div class="job-listing-meta">
                            <span class="badge badge-danger"><?= $item->jobType->name_en ?></span>
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