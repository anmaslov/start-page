<?php

namespace app\controllers;

use app\models\Style;
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
                        'actions' => ['index', 'state', 'updateState',
                            'style', 'updateStyle'],
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
            'updateStyle' => [
                'class' => 'dosamigos\editable\EditableAction',
                'modelClass' => new Style(),
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

    public function actionStyle()
    {
        $styles = Style::find()->all();
        return $this->render('style', [
            'model' => $styles
        ]);
    }


}
