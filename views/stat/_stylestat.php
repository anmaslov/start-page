<?php
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use \yii\helpers\Url;
?>

<?
$this->registerJs('$.getJSON("'.URL::to(['stat/style']).'", dataStyle);');

echo Highcharts::widget([
    'callback' => 'dataStyle',
    'scripts' => [
        'modules/funnel',
    ],
    'options' => [
        'chart' => ['type' => 'pyramid'],
        'title' => ['text' => Yii::t('app', 'STAT_DISTRIBUTION')],
        'colors' => ['#058DC7', '#50B432', '#ED561B', '#DDDF00', '#24CBE5', '#64E572', '#FF9655', '#FFF263', '#6AF9C4'],
        'series' => [[
            'name' => Yii::t('app', 'STAT_COUNT'),
            'data' => new JsExpression('data')
        ]]
    ]
]);
?>