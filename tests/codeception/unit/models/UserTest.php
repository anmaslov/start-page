<?php

namespace tests\codeception\unit\models;

use tests\codeception\unit\BaseTest;
use app\models\User;

class UserTest extends BaseTest
{
    public $modelClass = 'app\models\User';

    public function testAttributeHasLabels()
    {
        $this->attributesHaveLabels();
    }

}
