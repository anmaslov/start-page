<?php

use tests\codeception\_pages\SettingsPage;

/* @var $scenario Codeception\Scenario */

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that about works');

$contactPage = SettingsPage::openBy($I);

$I->see('Персональные настройки', 'h3');

$I->see('Редактирование информации', 'h3');
