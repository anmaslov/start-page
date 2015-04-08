<?php

namespace app\controllers;

use app\models\Block;
use app\models\Link;
use app\models\UserSettingsBlock;

class MainController extends \yii\web\Controller
{
    public function actionIndex()
    {

        //$dblock = new UserSettingsBlock;
        UserSettingsBlock::sync(1);
        //$block = Block::find()->with('links')->where(['hidden' => Block::STATUS_SHOW])->all();

        $model = UserSettingsBlock::find()
            //->innerJoinWith('block')
            ->with('block')
            ->where(['{{%user_settings_block}}.user_id' => 1])
            ->all();

        return $this->render('index', [
            'model' => $model,
        ]);
    }

}
