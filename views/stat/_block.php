<?php
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use \yii\helpers\Url;
?>

<?
$this->registerJs('$.getJSON("'.URL::to(['stat/block']).'", dataBlock);');

echo Highcharts::widget([
    'callback' => 'dataBlock',
    'options' => [
        'chart' => ['type' => 'column'],
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
                'borderWidth' => '0',
                'dataLabels' => [
                    'enabled' => 'true'
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