<?php

namespace tests\codeception\unit\models;

use Yii;
use tests\codeception\unit\BaseTest;
use app\models\Link;

class LinkTest extends BaseTest
{
    public $modelClass = 'app\models\Link';

    public function testAttributeHasLabels()
    {
        $this->attributesHaveLabels();
    }
}