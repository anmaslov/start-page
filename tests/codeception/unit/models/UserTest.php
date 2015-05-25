<?php

namespace tests\codeception\unit\models;

use Yii;
use tests\codeception\unit\BaseTest;
use tests\codeception\unit\fixtures\UserFixture;
use app\models\User;

class UserTest extends BaseTest
{
    public $modelClass = 'app\models\User';

    public function testAttributeHasLabels()
    {
        $this->attributesHaveLabels();
    }

    public function testUserIp()
    {
        $user = $this->users['user1'];
        expect('should be like fixture file', $user['ip'])->equals('192.168.0.1');
    }

    public function fixtures()
    {
        return [
            'users' => [
                'class' => UserFixture::className(),
                'dataFile' => '@tests/codeception/unit/fixtures/data/user.php'
            ],
        ];

    }

}
