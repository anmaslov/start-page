<?php

use tests\codeception\_pages\LoginPage;

/* @var $scenario Codeception\Scenario */

$I = new FunctionalTester($scenario);
$I->wantTo('ensure that login works');

//$loginPage = LoginPage::openBy($I);

$I->amGoingTo('Exist record with id=1');
$category = $I->seeRecord('app\models\User', array('id' => '1'));
