<?php
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use \yii\helpers\Url;
?>

<?
$this->registerJs('$.getJSON("'.URL::to(['stat/link-stat-by-date']).'", linkstsbyday);');

echo Highcharts::widget([
    'callback' => 'linkstsbyday',
    'scripts' => [
        'modules/drilldown',
    ],
    'options' => [
        'chart' => ['type' => 'spline'],
        'title' => ['text' => Yii::t('app', 'STAT_LINK_CLICKING')],
        'subtitle' => ['text' => Yii::t('app', 'STAT_LINK_CLICKING_COUNT')],
        'xAxis' => ['type' => 'category'],
        'yAxis' => [
            'min' => 0,
            'title' => [
                'text' => Yii::t('app', 'STAT_COUNT')
            ]
        ],
        'legend' => [
            'enabled' => false
        ],
        'plotOptions' =>[
            'spline' => [
                'lineWidth' => '4',
                'states' => [
                    'hover' => [
                        'lineWidth' => 5
                    ]
                ],
                'marker' => [
                    'enabled' => true
                ]
            ]
        ],
        'series' => [[
            'name' => Yii::t('app', 'STAT_COUNT'),
            'data' => new JsExpression('data.dt'),
            /*'data' => [
                ['name' => 'Microsoft Internet Explorer', 'y' => 56, 'drilldown' => 'Microsoft Internet Explorer'],
                ['name' => 'Chrome', 'y' => 23, 'drilldown' => 'Chrome'],
                ['name' => 'Firefox', 'y' => 10, 'drilldown' => null],
            ],*/
        ]],
        'drilldown' => [
            'series' => new JsExpression('data.drill'),
        ]
        /*'drilldown' => [
            'series' => [
                ['name' => 'Microsoft Internet Explorer', 'id' => 'Microsoft Internet Explorer', 'data' => [
                    ["v11.0", 24], ["v12", 25], ["v7", 4]
                ]],
                ['name' => 'Chrome', 'id' => 'Chrome', 'data' => [
                    ["v11.0", 24], ["v12", 25], ["v7", 4]
                ]],
            ]
        ]*/
    ]
]);
?>