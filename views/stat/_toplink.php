<?php
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use \yii\helpers\Url;
?>

<?
$this->registerJs('$.getJSON("'.URL::to(['stat/top-links']).'", topLink);');

echo Highcharts::widget([
    'callback' => 'topLink',
    'options' => [
        'chart' => ['type' => 'column'],
        'title' => ['text' => Yii::t('app', 'STAT_TOP_LINK')],
        'xAxis' => [
            'type' => 'category',
            'labels' => ['rotation' => -45],
        ],
        'yAxis' => [
            'min' => 0,
            'title' => [
                'text' => Yii::t('app', 'STAT_LINK_CLICKING')
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
            'data' => new JsExpression('data'),
        ]]
    ]
]);
?>