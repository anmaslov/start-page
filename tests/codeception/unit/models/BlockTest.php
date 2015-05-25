<?php

namespace tests\codeception\unit\models;

use Yii;
use tests\codeception\unit\BaseTest;
use app\models\Block;

class BlockTest extends BaseTest
{
    public $modelClass = 'app\models\Block';

    public function testAttributeHasLabels()
    {
        $this->attributesHaveLabels();
    }
}