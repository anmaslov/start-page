<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=page',
    'username' => 'mysql',
    'password' => 'mysql',
    'tablePrefix' => 'pg_',
    'charset' => 'utf8',
    'enableSchemaCache' => true, //Caching table scheme (clear cache: php yii cache/flush)
];
