<?php

/* @var $scenario Codeception\Scenario */

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that main page works');
$I->amOnPage(Yii::$app->homeUrl);
$I->see('Start page', 'title');

$I->seeLink('Statistics');
$I->click('Statistics');
$I->see('Statistics');
