<?php

/* @var $scenario Codeception\Scenario */

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that main page works');
$I->amOnPage(Yii::$app->homeUrl);
$I->see('Стартовая страница', 'title');

$I->seeLink('Статистика');
$I->click('Статистика');
$I->see('Статистика');
