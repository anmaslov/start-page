<?php

use tests\codeception\_pages\SettingsPage;

/* @var $scenario Codeception\Scenario */

$I = new FunctionalTester($scenario);
$I->wantTo('ensure that settings works');
SettingsPage::openBy($I);
$I->see('Персональные настройки', 'h3');

$I->see('Справочники');
$I->click('Справочники');

$I->click('Состояния блоков');
$I->see('Состояния блоков', 'h3');
$I->click('К списку справочников');

$I->click('Состояния блоков');
$I->see('Состояния блоков', 'h3');
$I->click('К списку справочников');

$I->click('Визуальное оформление');
$I->see('Визуальное оформление', 'h3');
$I->click('К списку справочников');

$I->click('Виды ролей');
$I->see('Виды ролей', 'h3');
$I->click('К списку справочников');

$I->click('Список иконок');
$I->see('Список иконок', 'h3');
$I->click('К списку справочников');