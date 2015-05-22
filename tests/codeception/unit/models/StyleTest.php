<?php

namespace tests\codeception\unit\models;

use yii\codeception\DbTestCase;
use tests\codeception\fixtures\StyleFixture;


class StyleTest extends DbTestCase
{
    public function fixtures()
    {
        return [
            'styles' => StyleFixture::className(),
        ];
    }

    public function testCorrectStyle()
    {
        expect('username should be correct', 'test1')->equals('test1');
    }
}