<?php
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use \yii\helpers\Url;
/* @var $this yii\web\View */
?>
<h1><?=Yii::t('app', 'STAT')?>:</h1>

<div class="row">
    <div class="col-md-12">
        <?= $this->render('_count_link.php') ?>
    </div>
</div>

<div class="row">
    <div class="col-md-10 col-md-offset-1">
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

<!--
<div class="row">
    <div class="col-md-6">
        <?//= $this->render('_styleStat') ?>
    </div>
    <div class="col-md-6">
        <?//= $this->render('_block') ?>
    </div>
</div>
-->

