<?php

namespace tests\codeception\unit\models;

use Yii;
use tests\codeception\unit\BaseTest;
use app\models\Block;

class BlockTest extends BaseTest
{
    protected function setUp()
    {
        parent::setUp();
        $this->modelClass = new Block();
    }

    public function testAttributeHasLabels()
    {
        $this->attributesHaveLabels();
    }
}