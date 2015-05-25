<?php

namespace tests\codeception\unit;

use Yii;
use yii\codeception\DbTestCase;

class BaseTest extends DbTestCase
{
    public $modelClass;

    public function attributesHaveLabels()
    {
        $attributes = array_keys($this->modelClass->attributes);

        foreach ($attributes as $attribute) {
            $this->assertArrayHasKey($attribute, $this->modelClass->attributeLabels());
        }
    }

}