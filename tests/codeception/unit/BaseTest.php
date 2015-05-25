<?php

namespace tests\codeception\unit;

use Yii;
use yii\codeception\DbTestCase;

class BaseTest extends DbTestCase
{
    public $modelClass;

    public function attributesHaveLabels()
    {
        $modelClass = new $this->modelClass;

        $attributes = array_keys($modelClass->attributes);

        foreach ($attributes as $attribute) {
            $this->assertArrayHasKey($attribute, $modelClass->attributeLabels());
        }
    }

}