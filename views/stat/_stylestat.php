<?php
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use \yii\helpers\Url;
?>

<?
$this->registerJs('$.getJSON("'.URL::to(['stat/style']).'", dataStyle);');

echo Highcharts::widget([
    'callback' => 'dataStyle',
    'options' => [
        'title' => ['text' => Yii::t('app', 'STAT_DISTRIBUTION')],
        //'colors' => ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4'],
        'plotOptions' =>[
            'pie' => [
                'allowPointSelect' => 'true',
                'cursor' => 'pointer',
                'depth' => 35,
                'dataLabels' => [
                    'enabled' => 'false'
                ]
            ]
        ],
        'series' => [[
            'type' => 'pie',
            'name' => Yii::t('app', 'STAT_COUNT'),
            'data' => new JsExpression('data')
            /*'data' => [
                ['name' => 'ubuntu', 'y' => 45, 'sliced' => true],
                ['name' => 'default', 'y' => 6, 'sliced' => true],
                ['name' => 'test', 'y' => 45],
            ]*/
        ]]
    ]
]);
?>