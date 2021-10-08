<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Appeals */

$this->title = Yii::t('app', 'Create Appeals');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Appeals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appeals-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
