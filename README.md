Simple start page based on Yii 2 [![Yii2](https://img.shields.io/badge/Powered_by-Yii_Framework-green.svg?style=flat)](http://www.yiiframework.com/)
================================

REQUIREMENTS
------------

Minimum requirements - support the server version of PHP 5.4.0.

INSTALL
------------

### Install via Composer

If you do not have [Composer](http://getcomposer.org/) - you may install it by following the instructions at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install this start-page using the following command

~~~
composer create-project --stability=dev anmaslov/start-page
~~~

Now you should be able to access the application through the following URL, assuming basic is the directory directly under the Web root.

~~~
http://localhost/start-page/web/
~~~

CONFIGURATION
------------

### Database
Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

**NOTE:** Yii won't create the database for you, this has to be done manually before you can access it.

Also check and edit the other files in the `config/` directory to customize your application.

### Migration

Apply migration

~~~
.\yii migrate
~~~

### Second mode

~~~
git clone https://github.com/anmaslov/start-page.git
~~~

go to project folder

~~~
cd start-page
~~~

then run

~~~
composer install
yii init
~~~

Then configure database connection `config/db.php` and apply all migration `.\yii migrate`