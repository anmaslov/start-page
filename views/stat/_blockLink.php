<?php
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use \yii\helpers\Url;
?>

<?
$this->registerJs('$.getJSON("'.URL::to(['stat/block-link']).'", blockLink);');

echo Highcharts::widget([
    'callback' => 'blockLink',
    'options' => [
        'title' => ['text' => Yii::t('app', 'STAT_TOP_BLOCK_LINK')],
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
        ]]
    ]
]);
?>