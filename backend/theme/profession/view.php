<?php

use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Profession */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Professions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="profession-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
<!--    --><?//= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <a type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-update-profession">Update</a>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php
    Modal::begin([
        'id' => 'modal-update-profession',
        'size'=>'lg'
    ]);
    echo $this->render('update', [
        'model' => $model
    ]);

    Modal::end();
    ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name_uz',
            'name_ru',
            'name_en',
            'name_cyrl',
        ],
    ]) ?>

</div>
