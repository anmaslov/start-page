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
        'title' => ['text' => 'Количестово ссылок'],
        'subtitle' => ['text' => 'Число ссылок, принадлежащих блокам'],
        'xAxis' => ['type' => 'category'],
        'yAxis' => [
            'title' => [
                'text' => 'Количество ссылок в блоке'
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
            'name' => 'Количество',
            'colorByPoint' => true,
            'data' => new JsExpression('data')
        ]]
    ]
]);
?>