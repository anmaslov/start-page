<?php

namespace tests\codeception\functional;

use app\models\User;
use tests\codeception\_pages\SettingsPage;

class ReferenceCest
{

    /**
     * This method is called before each cest class test method
     * @param \Codeception\Event\TestEvent $event
     */
    public function _before($event)
    {
        $user = User::find()->where(['ip' => 'noip'])->one();
        $authManager = \Yii::$app->getAuthManager();
        $userRole = $authManager->getRole('admin');
        $authManager->assign($userRole, $user->id);
    }

    /**
     * This method is called after each cest class test method, even if test failed.
     * @param \Codeception\Event\TestEvent $event
     */
    public function _after($event)
    {
        $user = User::find()->where(['ip' => 'noip'])->one();
        $authManager = \Yii::$app->getAuthManager();
        $userRole = $authManager->getRole('admin');
        $authManager->revoke($userRole, $user->id);
    }

    /**
     * This method is called when test fails.
     * @param \Codeception\Event\FailEvent $event
     */
    public function _fail($event)
    {

    }

    /**
     *
     * @param \codeception_frontend\FunctionalTester $I
     * @param \Codeception\Scenario $scenario
     */
    public function testRefSettings($I, $scenario)
    {
        $I->wantTo('ensure that signup works');

        $signupPage = SettingsPage::openBy($I);
        $I->see('Personal settings', 'h3');

        $I->seeLink('Reference');
        $I->click('Reference');

        $I->seeLink('Block state');
        $I->click('Block state');
        $I->see('Block state', 'h3');
        $I->click('Back to reference');

        $I->seeLink('Visual style');
        $I->click('Visual style');
        $I->see('Visual style', 'h3');
        $I->click('Back to reference');

        $I->seeLink('Role types');
        $I->click('Role types');
        $I->see('Role types', 'h3');
        $I->click('Back to reference');

        $I->seeLink('Icons list');
        $I->click('Icons list');
        $I->see('Icons list', 'h3');
        $I->click('Back to reference');
    }
}