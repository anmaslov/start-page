<?php
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use \yii\helpers\Url;

$url = URL::to(['stat/every-min', 'limit' => 1]);

$jsData = <<<JS
 function () {
        var series = this.series[0];
        var timerId = setTimeout(function getLast() {
            $.getJSON('$url', function(response){
                
                var len = series.data.length;
                lastValX = series.points[len-1].name
                
                dataY = series.processedYData;
                lastValY = dataY[dataY.length-1];
                
                if (response[0].name != lastValX){ //add new point
                    var x = response[0].name
                        y = response[0].y;
                    series.addPoint([x, y], true, true);
                }else if(response[0].y != lastValY){ //only point update
                     var x = response[0].name
                        y = response[0].y;
                    series.data[len-1].update([x, y], true, true);
                }
                
                timerId = setTimeout(getLast, 2000);
            });
        }, 2000);
    }
JS;

$jsChart = <<<JS
function (chart) {
    if (!chart.renderer.forExport) {
        setInterval(function () {
            var point = chart.series[0].points[0],
                newVal,
                inc = Math.round((Math.random() - 0.5) * 20);

            newVal = point.y + inc;
            if (newVal < 0 || newVal > 200) {
                newVal = point.y - inc;
            }

            point.update(newVal);

        }, 3000);
    }
});
JS;


//$this->registerJs('$.getJSON("'.URL::to(['stat/every-min']).'", speed);');

echo Highcharts::widget([
    'callback' => 'speed',
    'scripts' => [
        'modules/funnel',
    ],
    'options' => [
        'chart' => [
            'type' => 'gauge',
            'plotBackgroundColor' => null,
            'plotBackgroundImage' => null,
            'plotBorderWidth' => 0,
            'plotShadow' => false
            ],
        'title' => ['text' => Yii::t('app', 'STAT_COUNT_OF_CLICK_PER5')],
        'pane' => [
            'startAngle' => -150,
            'endAngle' => 150,
            'background' => [
                [
                    'backgroundColor' =>
                    ['linearGradient' => [ 'x1'=> 0, 'y1' => 0, 'x2' => 0, 'y2' => 1 ],
                  'stops' => [
                        ['0' => '#FFF'],
                        ['1' => '#333']
                    ]
                ],
                'borderWidth' => 0,
                'outerRadius' => '109%',
                ],
                [
                    'backgroundColor' => [
                    'linearGradient' => [ 'x1'=> 0, 'y1' => 0, 'x2' => 0, 'y2' => 1 ],
                    'stops' => [
                            ['0' => '#333'],
                            ['1' => '#FFF']
                        ]
                    ],
                    'borderWidth' => 1,
                    'outerRadius' => '107%'
                ],
                [
                'backgroundColor' => '#DDD',
                    'borderWidth' => 0,
                    'outerRadius' => '105%',
                    'innerRadius' => '103%'
                ]
            ]
        ],

        'yAxis' => [
            'min' => 0,
                'max' => 200,

                'minorTickInterval' => 'auto',
                'minorTickWidth' => 1,
                'minorTickLength' => 10,
                'minorTickPosition' => 'inside',
                'minorTickColor' => '#666',

                'tickPixelInterval' => 30,
                'tickWidth' => 2,
                'tickPosition' => 'inside',
                'tickLength' => 10,
                'tickColor' => '#666',
                'labels' => [
                    'step' => 2,
                    'rotation' => 'auto'
                ],
                'title' => [
                    'text' => 'km/h'
                ],
                'plotBands' => [
                    [
                        'from' => 0,
                        'to' => 120,
                        'color' => '#55BF3B' // green
                    ], [
                        'from' => 120,
                        'to' => 160,
                        'color' => '#DDDF0D' // yellow
                    ], [
                        'from' => 160,
                        'to' => 200,
                        'color' => '#DF5353' // red
                ]]
            ],
        'series' => [[
            'name' => Yii::t('app', 'STAT_COUNT'),
            //'data' => new JsExpression('data')
            'data' => [80],
            'tooltip' => [
                'valueSuffix'=> ' km/h'
            ]
        ]]
    ]
]);
