<?php

use dosamigos\chartjs\ChartJs;
use frontend\models\Report;
use bsadnu\googlecharts\ColumnChart;



/**
 *
 * @var  $result \frontend\models\Report
 * @var  $seriya \frontend\models\Report
 */
$this->title = 'Starter Page';
$this->params['breadcrumbs'] = [['label' => $this->title]];
$region_list = (new \yii\db\Query())->select('nameUz')->from('region')->all();
//Report::vacancyCount();
?>
<div class="container-fluid">

        <div class="card card-danger"   >
            <div class="card-header">
                <h3 class="card-title">Pie Chart</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <?php echo ChartJs::widget([
                    'type' => 'pie',
                    'id' => 'structurePie',
                    'options' => [
                        'height' => 200,
                        'width' => 400,
                    ],
                    'data' => [
                        'radius' => "90%",
                        'labels' => [
                            'Andijon',
                            'Namangan',
                            'Xorazm',
                            'Toshkent vil.',
                            'Toshkent',
                            'Buxoro',
                            'Samarqand',
                            'Jizzax',
                            'Navoiy',
                            "Qoraqalpog'iston",
                            'Sirdaryo',
                            'Surxondaryo',
                            'Qashqadaryo',
                            "Farg'ona"
                        ],
                        'datasets' => [
                            [
                                'data' => $count, // Your dataset
                                'label' => '',
                                'backgroundColor' => [
                                    '#ADC3FF',
                                    '#FF9A9A',
                                    '#42f595',
                                    '#8742f5',
                                    '#e342f5',
                                    '#f5429e',
                                    '#f5d142',


                                ],
                                'borderColor' => [
                                    '#fff',
                                    '#fff',
                                    '#fff'
                                ],
                                'borderWidth' => 1,
                                'hoverBorderColor' => ["#999", "#999", "#999"],
                            ]
                        ]
                    ],
                    'clientOptions' => [
                        'legend' => [
                            'display' => false,
                            'position' => 'bottom',
                            'labels' => [
                                'fontSize' => 14,
                                'fontColor' => "#425062",
                            ]
                        ],
                        'tooltips' => [
                            'enabled' => true,
                            'intersect' => true
                        ],
                        'hover' => [
                            'mode' => false
                        ],
                        'maintainAspectRatio' => false,

                    ],
                    'plugins' =>
                        new \yii\web\JsExpression("
        [{
        afterDatasetsDraw: function(chart, easing) {
        var ctx = chart.ctx;
        chart.data.datasets.forEach(function (dataset, i) {
        var meta = chart.getDatasetMeta(i);
        if (!meta.hidden) {
        meta.data.forEach(function(element, index) {
        // Draw the text in black, with the specified font
        ctx.fillStyle = 'rgb(0, 0, 0)';

        var fontSize = 16;
        var fontStyle = 'normal';
        var fontFamily = 'Helvetica';
        ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);

        // Just naively convert to string for now
        var dataString = dataset.data[index].toString()+'%';

        // Make sure alignment settings are correct
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';

        var padding = 5;
        var position = element.tooltipPosition();
        ctx.fillText(dataString, position.x, position.y - (fontSize / 2) - padding);
        });
        }
        });
        }
        }]")
                ])
                ?>
            </div>
            <!-- /.card-body -->
        </div>
    <?php
//    vd($generalChart);
    ?>
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title">Bar Chart</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
    <?= \bsadnu\googlecharts\ColumnChart::widget([
        'id' => 'my-column-chart-id',
        'data' => $generalChart,
        'options' => [
            'fontName' => 'Times new Roman',
            'height' => 400,
            'fontSize' => 12,
            'chartArea' => [
                'left' => '5%',
                'width' => '90%',
                'height' => 350
            ],
            'tooltip' => [
                'textStyle' => [
                    'fontName' => 'Times new roman',
                    'fontSize' => 13
                ]
            ],
            'vAxis' => [
                'title' => 'Sales and Expenses',
                'titleTextStyle' => [
                    'fontSize' => 13,
                    'italic' => false
                ],
                'gridlines' => [
                    'color' => '#e5e5e5',
                    'count' => 10
                ],
                'minValue' => 0
            ],
            'legend' => [
                'position' => 'top',
                'alignment' => 'center',
                'textStyle' => [
                    'fontSize' => 12
                ]
            ]
        ]
    ]) ?>
    </div>
</div>


</div>