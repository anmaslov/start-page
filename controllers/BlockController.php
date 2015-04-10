<?php

namespace app\controllers;

use app\models\Block;
use yii\filters\AccessControl;

class BlockController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['index', 'update'],
                'rules' => [
                    /*[
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['@'],
                    ],*/
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $model = Block::find()->with('links')->where(['hidden' => Block::STATUS_SHOW])->all();

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionEditBlock()
    {

    }

}
