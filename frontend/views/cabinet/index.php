<?php

use yii\helpers\Html;

$lang = 'name_' . Yii::$app->language;
$langTolower = 'name' . ucfirst(Yii::$app->language);
?>
<?php  if ($company->apply_messages > 0): ?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    Sizga xabar keldi <a href="/cabinet/apply-messages/" class="alert-link"><span
                class="badge badge-primary"><?= $company->apply_messages ?></span></a>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php endif; ?>
<?php if ($company->apply_messages > 0): ?>
<audio id="myAudio"  autoplay  >
    <source  src="/frontend/web/notification3.mp3" type="audio/mp3">
</audio>

<?php endif; ?>
<h2><?= ucfirst($company->name) . '  ' . Yii::t('app', 'Company informations') ?></h2>
<?= \yii\widgets\DetailView::widget([
    'model' => $company,
    'attributes' => [
        'name',
        'director_name',
        [
            'attribute' => 'regionId',
            'label' => Yii::t('app', 'Region'),
            'value' => $company->region->$langTolower
        ],
        [
            'attribute' => 'cityId',
            'label' => Yii::t('app', 'City'),
            'value' => $company->city->$langTolower
        ],

        'address',
        'phone',
        [
            'attribute' => 'image',
            'value' => '@web/uploads/company/' . $company->logo,
            'format' => ['image', ['width' => '150', 'height' => '150']]
        ],
    ],
]);
?>
<?= Html::a(Yii::t('app', 'Edit'), '/cabinet/edit', ['class' => 'btn btn-success']) ?>

<script >
    var x = document.getElementById("myAudio");
    x.autoplay = true;
    x.load();
</script>

