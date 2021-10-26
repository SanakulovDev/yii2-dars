<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Vacancy */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vacancies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$lang = 'name_'.Yii::$app->language;
$langTolower = 'name'.ucfirst(Yii::$app->language);
?>

<div class="vacancy-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute'=>'company_id',
                'label'=>Yii::t('app','Company name'),
                'value'=>$model->company->name
            ],
            [
                    'attribute'=>'user_id',
                    'label'=>Yii::t('app','User name'),
                    'value'=>$model->user->username
            ],
            [
                'attribute' => 'profession_id',
                'label' => Yii::t('app', 'Profession name'),
                'value' => $model->profession->$lang
            ],
            'description_uz:html',
            'description_ru:html',
            'description_en:html',
            'description_cyrl:html',
            [
                'attribute' => 'job_type_id',
                'label' => Yii::t('app', 'Job type'),
                'value' => $model->jobType->$lang
            ],
            [
                'attribute' => 'region_id',
                'label' => Yii::t('app', 'Region'),
                'value' => $model->region->$langTolower
            ],
            [
                'attribute' => 'city_id',
                'label' => Yii::t('app', 'City / District'),
                'value' => $model->city->$langTolower
            ],
            [
                'attribute' => 'image',
                'value' => '@web/uploads/vacancy/' . $model->image,
                'format' => ['image', ['width' => '150', 'height' => '150']]
            ],
            'count_vacancy',
            'salary',
            [
                'attribute' => 'gender',
                'label' => Yii::t('app', 'Gender'),
                'value' => $model->genders->$lang
            ],
            'experience',
            'telegram',
            'address',
            'views',
            'status',
            'deadline',
            'created_at',

        ],
    ]) ?>

</div>
