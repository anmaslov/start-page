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


$this->registerJs('$.getJSON("'.URL::to(['stat/every-min']).'", loadData);');

echo Highcharts::widget([
    'callback' => 'loadData',
    'scripts' => [
        'modules/funnel',
    ],
    'options' => [
        'chart' => [
            'type' => 'spline',
            'events' => [
                'load' => new JsExpression($jsData)
            ]
        ],
        'title' => ['text' => Yii::t('app', 'STAT_COUNT_OF_CLICK')],
        'xAxis' => ['type'=> 'category'],
        'yAxis' => [
            'title' => ['text'=> null],
            'plotLines'=> [
                [
                    'value'=> 0,
                    'width' => 1,
                    'color' => '#ff0000'
                ]
            ]
        ],
        'series' => [[
            'name' => Yii::t('app', 'STAT_COUNT'),
            'data' => new JsExpression('data')
        ]]
    ]
]);
