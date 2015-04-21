<?php

namespace app\controllers;

use yii\filters\AccessControl;
use app\models\State;


class ReferenceController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index', 'state', 'updateState'],
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'updateState' => [
                'class' => 'dosamigos\editable\EditableAction',
                'modelClass' => new State(),
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionState()
    {
        $states = State::find()->all();
        return $this->render('state', [
            'model' => $states
        ]);
    }


}
