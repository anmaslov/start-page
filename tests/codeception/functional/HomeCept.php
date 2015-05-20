<?php

/* @var $scenario Codeception\Scenario */

$I = new FunctionalTester($scenario);
$I->wantTo('ensure that home page works');
$I->amOnPage(Yii::$app->homeUrl);
$I->see('Стартовая страница');
$I->seeLink('Статистика');
$I->click('Статистика');
$I->see('Статистика');
