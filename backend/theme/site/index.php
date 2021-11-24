<?php

use dosamigos\chartjs\ChartJs;
use frontend\models\Report;
use miloschuman\highcharts\Highcharts;
use practically\chartjs\Chart;
use yii\web\JsExpression;

/**
 *
 * @var  $result \frontend\models\Report
 * @var  $seriya \frontend\models\Report
 */
$this->title = 'Starter Page';
$this->params['breadcrumbs'] = [['label' => $this->title]];
$region_list = (new \yii\db\Query())->select('nameUz')->from('region')->all();

//vd($result);
?>
<div class="container-fluid">
    <div class="row">



       <?php  $series = $seriya;
//        vd($series);
        echo \onmotion\apexcharts\ApexchartsWidget::widget([
        'type' => 'bar', // default area
        'height' => '500', // default 350
        'width' => '800', // default 100%
        'chartOptions' => [
        'chart' => [
        'toolbar' => [
        'show' => true,
        'autoSelected' => 'zoom'
        ],
        ],
        'xaxis' => [
        'type' => 'datetime',
        // 'categories' => $categories,
        ],
        'plotOptions' => [
        'bar' => [
        'horizontal' => false,
        'endingShape' => 'rounded'
        ],
        ],
        'dataLabels' => [
        'enabled' => false
        ],
        'stroke' => [
        'show' => true,
        'colors' => ['transparent']
        ],
        'legend' => [
        'verticalAlign' => 'bottom',
        'horizontalAlign' => 'left',
        ],
        ],
        'series' => $series
        ]);
        ?>
    </div>
</div>