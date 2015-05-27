<?php

namespace app\controllers;

use app\models\User;
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

    public function actions()
    {
        return [
            'user' => [
                'class' => 'dosamigos\editable\EditableAction',
                'modelClass' => new User(),
            ],
        ];
    }

    public function actionIndex()
    {
        $curUser = User::findOne(\Yii::$app->user->id);
        return $this->render('index', [
            'user' => $curUser
        ]);
    }

    public function actionReset()
    {
        $curUser = \Yii::$app->user->id;
        if (UserSettingsBlock::del($curUser)){
            UserSettingsBlock::sync($curUser);
            \Yii::$app->getSession()->setFlash('success', Yii::t('app', 'RESET_SETTINGS_SUCCESS'));
            return $this->redirect(['index']);
        }

    }
}
