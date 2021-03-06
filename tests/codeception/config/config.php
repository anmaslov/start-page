<?php
/**
 * Application configuration shared by all test types
 */
return [
    'controllerMap' => [
        'fixture' => [
            'class' => 'yii\faker\FixtureController',
            'fixtureDataPath' => '@tests/codeception/fixtures',
            'templatePath' => '@tests/codeception/templates',
            'namespace' => 'tests\codeception\fixtures',
        ],
    ],
    'language' => 'en-EN',
    'components' => [
        'db' => [
            'dsn' => 'mysql:host=localhost;dbname=page_tests',
            'username' => 'mysql',
            'password' => 'mysql',
            'tablePrefix' => 'test_',
        ],
        'mailer' => [
            'useFileTransport' => true,
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
    ],
];
