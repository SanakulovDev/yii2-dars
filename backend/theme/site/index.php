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


<!--        --><?//= ChartJs::widget([
//            'type' => 'pie',
//            'id' => 'structurePie',
//            'options' => [
//                'height' => 500,
//                'width' => 1000,
//            ],
//            'data' => [
//                'radius' => "90%",
//                'labels' => [
//
//
//                ], // Your labels
//                'datasets' => [
//                    [
//                        'data' => ['35.6', '17.5', '46.9'], // Your dataset
//                        'label' => '',
//                        'backgroundColor' => [
//                            '#ADC3FF',
//                            '#FF9A9A',
//                            'rgba(190, 124, 145, 0.8)'
//                        ],
//                        'borderColor' => [
//                            '#fff',
//                            '#fff',
//                            '#fff'
//                        ],
//                        'borderWidth' => 1,
//                        'hoverBorderColor' => ["#999", "#999", "#999"],
//                    ]
//                ]
//            ],
//            'clientOptions' => [
//                'legend' => [
//                    'display' => false,
//                    'position' => 'bottom',
//                    'labels' => [
//                        'fontSize' => 14,
//                        'fontColor' => "#425062",
//                    ]
//                ],
//                'tooltips' => [
//                    'enabled' => true,
//                    'intersect' => true
//                ],
//                'hover' => [
//                    'mode' => false
//                ],
//                'maintainAspectRatio' => false,
//
//            ],
//            'plugins' =>
//                new \yii\web\JsExpression("
//                [{
//                    afterDatasetsDraw: function(chart, easing) {
//                        var ctx = chart.ctx;
//                        chart.data.datasets.forEach(function (dataset, i) {
//                            var meta = chart.getDatasetMeta(i);
//                            if (!meta.hidden) {
//                                meta.data.forEach(function(element, index) {
//                                    // Draw the text in black, with the specified font
//                                    ctx.fillStyle = 'rgb(0, 0, 0)' ;
//
//                                    var fontSize = 16;
//                                    var fontStyle = 'normal';
//                                    var fontFamily = 'Helvetica';
//                                    ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);
//
//                                    // Just naively convert to string for now
//                                    var dataString = dataset.data[index].toString()+'%';
//
//                                    // Make sure alignment settings are correct
//                                    ctx.textAlign = 'center';
//                                    ctx.textBaseline = 'middle';
//
//                                    var padding = 5;
//                                    var position = element.tooltipPosition();
//                                    ctx.fillText(dataString, position.x, position.y - (fontSize / 2) - padding);
//                                });
//                            }
//                        });
//                    }
//                }]")
//        ])
        ?>
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