<?php

namespace tests\codeception\unit\models;

use Yii;
use tests\codeception\unit\BaseTest;
use tests\codeception\unit\fixtures\StyleFixture;
use app\models\Style;

class StyleTest extends BaseTest
{

    protected function setUp()
    {
        parent::setUp();
        $this->modelClass = new Style();
    }

    public function testAttributeHasLabels()
    {
        $this->attributesHaveLabels();
    }

    public function testAttributeIsRequired()
    {
        $this->modelClass->name = '';
        $this->modelClass->title = '';

        $this->assertFalse($this->modelClass->validate(array('title')));
        $this->assertFalse($this->modelClass->validate(array('name')));
    }

    public function testAttributeMaxLengthIs64()
    {
        $this->modelClass->title = Yii::$app->security->generateRandomString(65);
        $this->assertFalse($this->modelClass->validate(array('title')));

        $this->modelClass->title = Yii::$app->security->generateRandomString(64);
        $this->assertTrue($this->modelClass->validate(array('title')));

        $this->modelClass->title = Yii::$app->security->generateRandomString(65);
        $this->assertFalse($this->modelClass->validate(array('name')));

        $this->modelClass->name = Yii::$app->security->generateRandomString(64);
        $this->assertTrue($this->modelClass->validate(array('name')));
    }

    public function testImgMaxLengthIs128()
    {
        $this->modelClass->img = Yii::$app->security->generateRandomString(129);
        $this->assertFalse($this->modelClass->validate(array('img')));

        $this->modelClass->img = Yii::$app->security->generateRandomString(128);
        $this->assertTrue($this->modelClass->validate(array('img')));
    }

    public function testExistDefault()
    {
        $style = Style::find()->where(['name' => 'default'])->one();

        expect('name should be like search', $style->name)->equals('default');
        expect('title should be like fixtures', $style->title)->equals('title-default');
    }

    public function fixtures()
    {
        return [
            'style' => [
                'class' => StyleFixture::className(),
                'dataFile' => '@tests/codeception/unit/fixtures/data/style.php'
            ],
        ];
    }
}