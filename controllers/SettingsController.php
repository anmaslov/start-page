<?php

namespace app\controllers;

use app\models\UserSettingsBlock;
use yii\filters\AccessControl;

class SettingsController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'reset'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'reset'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionReset()
    {
        $curUser = \Yii::$app->user->id;
        if (UserSettingsBlock::del($curUser)){
            UserSettingsBlock::sync($curUser);
            \Yii::$app->getSession()->setFlash('success', 'Настройки успешно сброшены!');
            return $this->redirect(['index']);
        }

    }
}
