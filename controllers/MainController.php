<?php

namespace app\controllers;

use app\models\Block;

class MainController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = Block::find()->with('links')->where(['hidden' => Block::STATUS_SHOW])->all();
        return $this->render('index', [
            'model' => $model,
        ]);
    }

}
