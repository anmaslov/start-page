<?php
use miloschuman\highcharts\Highcharts;
/* @var $this yii\web\View */
?>
<h1>Статистика:</h1>

<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <?
                echo Highcharts::widget([
                    'options' => [
                        'title' => ['text' => 'Распределение тем по пользователям'],
                        'plotOptions' =>[
                            'pie' => [
                                'allowPointSelect' => 'true',
                                'cursor' => 'pointer',
                                'dataLabels' => [
                                    'enabled' => 'false'
                                ],
                                'showInLegend' => 'true'
                            ]
                        ],
                        'series' => [[
                            'type' => 'pie',
                            'name' => 'Количество',
                            /*'data' => [
                                ['name' => 'ubuntu', 'y' => 45, 'sliced' => true],
                                ['name' => 'default', 'y' => 6, 'sliced' => true],
                                ['name' => 'test', 'y' => 45],
                            ]*/
                            'data' => $st
                        ]]
                    ]
                ]);
                    ?>
            </div>
        </div>
    </div>
    <div class="col-md-4">Два</div>
    <div class="col-md-4">Три</div>
</div>

