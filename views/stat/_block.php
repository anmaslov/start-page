<?php
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use \yii\helpers\Url;
?>

<?
$this->registerJs('$.getJSON("'.URL::to(['stat/block']).'", dataBlock);');

echo Highcharts::widget([
    'callback' => 'dataBlock',
    'scripts' => [
        'modules/funnel',
    ],
    'options' => [
        'chart' => ['type' => 'pyramid'],
        'title' => ['text' => Yii::t('app', 'STAT_LINK_COUNT')],
        'subtitle' => ['text' => Yii::t('app', 'STAT_LINK_COUNT_BLOCK')],
        'xAxis' => ['type' => 'category'],
        'yAxis' => [
            'title' => [
                'text' => Yii::t('app', 'STAT_LINK_COUNT_IN_BLOCK')
            ]
        ],
        'legend' => [
            'enabled' => false
        ],
        'plotOptions' =>[
            'series' => [
                'dataLabels' => [
                    'enabled' => 'true',
                    'format' => '<b>{point.name}</b> ({point.y:,.0f})',
                ]
            ]
        ],
        'series' => [[
            'name' => Yii::t('app', 'STAT_COUNT'),
            'colorByPoint' => true,
            'data' => new JsExpression('data')
        ]]
    ]
]);
?>