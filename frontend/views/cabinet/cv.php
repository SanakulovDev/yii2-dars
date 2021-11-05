<?php

use yii\data\ActiveDataProvider;
use yii\grid\GridView;

?>
<h1><?= Yii::t('app', ucfirst(Yii::$app->user->identity->username) . " " . Yii::t('app', ' personal information')) ?></h1>
<?php
/**
 *
 * @var \frontend\models\Worker $worker
 * @var \frontend\models\LaborActivity $laborActivity
 * @var \frontend\models\WorkerLanguage $workerLanguage
 */
$lang = 'name_' . Yii::$app->language;
$langTolower = 'name' . ucfirst(Yii::$app->language);
?>
<div class="row justify-content-between">
    <div class="col-sm-12">
        <table class="table table-hover">
            <tr>
                <td class="">
                    <?php
                    echo \yii\widgets\DetailView::widget([
                        'model' => $worker,
                        'options'=>['class'=>''],
                        'attributes' => [
                            'firstname',
                            'lastname',
                            'patronymic',
                            'birthdate',
                            [
                                'attribute' => 'regionId',
                                'label' => Yii::t('app', 'Region'),
                                'value' => $worker->region->$langTolower
                            ],
                            [
                                'attribute' => 'cityId',
                                'label' => Yii::t('app', 'City'),
                                'value' => $worker->city->$langTolower
                            ],
                            'address',
                            'phone',
                            [
                                'attribute' => 'gender',
                                'value' => $worker->genders->$lang
                            ],
                            'nationality_id',


                        ],
                    ]);
                    ?>
                </td>
                <td>
                    <img width="150px" class="img-fluid" src="/frontend/web/uploads/user/<?= $worker->photo ?>"
                         alt="Workerga tegishli rasm bo'ladi">
                </td>
            </tr>
        </table>

    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <table class="table">
            <tr>
                <td>
                    <h3 style="font-weight: bold;"><?= Yii::t('app', 'Hobbies') ?></h3>
                </td>
                <td>
                    <?= $worker->hobby ?>
                </td>
            </tr>
        </table>



    </div>
    <div class="col-md-4">
        <table class="table">
            <tr>
                <td>
                    <h4 style="font-weight: bold;"><?= Yii::t('app', 'Profession') ?>:</h4>
                </td>
                <td>
                    <?= $worker->professions->$lang ?>
                </td>
            </tr>
        </table>



    </div>
    <div class="col-md-12">

        <?php
        echo \yii\widgets\DetailView::widget([
            'model' => $worker,
            'options'=>['class'=>''],
            'attributes' => [
                [
                    'label' => 'Labor Activity',
                    'value' => function ($worker) use ($lang) {
                        $know_labor_activity = '';
                        if ($worker->laborActivity) {
                            foreach ($worker->laborActivity as $worker_labor_activity) {
                                $temp = $worker_labor_activity ? $worker_labor_activity->company_name . ' korxonasida ' . $worker_labor_activity->position . ' lavozimida ' . $worker_labor_activity->form_date . ' dan ' . $worker_labor_activity->to_date . ' gacha ' : ' ';
                                $know_labor_activity .= $temp . ' ';
                            }
                        }
                        return $know_labor_activity;
                    }
                ],
            ],
        ]);
        ?>

    </div>
</div>
<?php
echo \yii\widgets\DetailView::widget([
    'model' => $worker,
    'options'=>['class'=>''],
    'attributes' => [
        'hobby',
        [
            'attribute' => 'profession_id',
            'value' => $worker->professions->$lang
        ],
        [
            'label' => 'Languages',
            'value' => function ($worker) use ($lang) {
                $know_langs = '';
                if ($worker->workerLanguages) {
                    foreach ($worker->workerLanguages as $worker_lang) {
                        $temp = $worker_lang->languages ? $worker_lang->languages->$lang . ' ' . $worker_lang->rate . ', ' : ' ';
                        $know_langs .= $temp . ' ';
                    }
                }
                return $know_langs;
            }
        ],

    ],
]);
?>

