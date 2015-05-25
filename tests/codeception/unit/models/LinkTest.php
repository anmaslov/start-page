<?php

namespace tests\codeception\unit\models;

use Yii;
use tests\codeception\unit\BaseTest;
use app\models\Link;

class LinkTest extends BaseTest
{
    protected function setUp()
    {
        parent::setUp();
        $this->modelClass = new Link();
    }

    public function testAttributeHasLabels()
    {
        $this->attributesHaveLabels();
    }
}