<?php
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use \yii\helpers\Url;
?>

<?
$this->registerJs('$.getJSON("'.URL::to(['stat/link-stat-by-date']).'", linkstsbyday);');

echo Highcharts::widget([
    'callback' => 'linkstsbyday',
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
            'data' => new JsExpression('data')
        ]]
    ]
]);
?>