<?php

use yii\helpers\Html;

$lang = 'name_' . Yii::$app->language;
$description = 'description_' . Yii::$app->language;
?>
<span><?= Yii::t('app', 'Trending vacancy') ?></span>

    <ul class="job-listings mb-5 mr-auto row " style="flex-direction: column; align-content: flex-end; ">
        <?php foreach ($vacancy as $item): ?>
            <li class="job-listing d-block d-sm-flex pb-3 pb-sm-0 align-items-center">
                <a href="/site/vacancy-views?id=<?= $item->id ?>&get=false"></a>
                <div class="job-listing-about d-sm-flex custom-width w-100 justify-content-between p-2">
                    <div class="job-listing-position custom-width  mb-3 mb-sm-0">
                        <h6><?= $item->profession? $item->profession->$lang:''?></h6>
                        <?php if ($item->$description): ?>
                            <?php
                            if (strlen($item->$description) > 50)
                                $str = substr($item->$description, 0, 50);
                            $str .= '...';
                            ?>

                            <p class="m-0 p-0"><?= $str?></p>
                        <?php endif; ?>
                        <i class="far fa-eye"></i>
                        <strong><?= $item->views ?></strong>
                    </div>

                </div>
            </li>
        <?php endforeach; ?>
    </ul>
