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
        'title' => ['text' => 'Переходы по ссылкам'],
        'subtitle' => ['text' => 'Число переходов по ссылкам'],
        'xAxis' => ['type' => 'category'],
        'yAxis' => [
            'title' => [
                'text' => 'Количество переходов'
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
            'name' => 'Количество',
            'data' => new JsExpression('data')
        ]]
    ]
]);
?>