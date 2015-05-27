<?php

/* @var $scenario Codeception\Scenario */

$I = new FunctionalTester($scenario);
$I->wantTo('ensure that home page works');
$I->amOnPage(Yii::$app->homeUrl);
$I->see('Стартовая страница');

$I->seeLink('Статистика');
$I->click('Статистика');
$I->see('Статистика');

$I->amOnPage(Yii::$app->homeUrl);
$I->see('Test block');

$I->amOnPage(['block/edit-user-block','id'=>'2']);
$I->see('Test block');
