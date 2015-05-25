<?php

namespace tests\codeception\unit\models;

use Yii;
use tests\codeception\unit\BaseTest;
use app\models\UserSettingsBlock;

class UserSettingsTest extends BaseTest
{
    protected function setUp()
    {
        parent::setUp();
        $this->modelClass = new UserSettingsBlock();
    }

    public function testAttributeHasLabels()
    {
        $this->attributesHaveLabels();
    }


}