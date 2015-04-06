<?php

// NOTE: Make sure this file is not accessible when deployed to production
if (!in_array(@$_SERVER['REMOTE_ADDR'], ['127.0.0.1', '10.39.0.12', '10.39.3.239', '::1'])) {
    die('You are not allowed to access this file.'.$_SERVER['REMOTE_ADDR']);
}

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');

require(__DIR__ . '/c3.php');
require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../tests/codeception/config/acceptance.php');

(new yii\web\Application($config))->run();
