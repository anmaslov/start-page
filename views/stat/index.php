<?php
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use \yii\helpers\Url;
/* @var $this yii\web\View */
?>
<h1><?=Yii::t('app', 'STAT')?>:</h1>

<div class="row">
    <div class="col-md-4">
        <?= $this->render('_styleStat') ?>
    </div>
    <div class="col-md-4">
        <?= $this->render('_block') ?>
    </div>
    <div class="col-md-4">
        <?= $this->render('_linkStatByDate.php') ?>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <?= $this->render('_toplink') ?>
    </div>
    <div class="col-md-6">
        <?= $this->render('_blockLink') ?>
    </div>
</div>

