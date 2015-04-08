<?php

namespace app\controllers;

use app\models\Block;
use app\models\UserSettingsBlock;

class MainController extends \yii\web\Controller
{
    public function actionIndex()
    {

        //$dblock = new UserSettingsBlock;
        UserSettingsBlock::sync(1);

        $model = Block::find()->with('links')->where(['hidden' => Block::STATUS_SHOW])->all();
        return $this->render('index', [
            'model' => $model,
        ]);
    }

}
