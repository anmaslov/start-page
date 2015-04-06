<?php

use tests\codeception\_pages\LoginPage;

/* @var $scenario Codeception\Scenario */

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that login works');

$loginPage = LoginPage::openBy($I);

$I->expectTo('see user info');
$I->see('Logout');

$I->wantTo('See user info');
//$I->haveRecord('app\models\User', array('ip' => '10.39.0.12'));