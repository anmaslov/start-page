<?php

namespace app\controllers;

use app\models\UserSettingsBlock;
use yii\filters\AccessControl;

class MainController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'update'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => ['moder'],
                    ],
                ],
            ],
        ];
    }

    /***
     * List of all blocks
     * @return string
     */
    public function actionIndex()
    {
        $curUser = \Yii::$app->user->id;
        UserSettingsBlock::sync($curUser); //todo return data model
        //$block = Block::find()->with('links')->where(['hidden' => Block::STATUS_SHOW])->all();

        $model = UserSettingsBlock::find()
            //->innerJoinWith('block')
            ->with('block')
            ->orderBy('column, order')
            ->where(['{{%user_settings_block}}.user_id' => $curUser])
            ->all();

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    /***
     * Update block information
     * @throws \yii\base\ExitException
     */
    public function actionUpdate()
    {
        $items = \Yii::$app->request->get('items');
        UserSettingsBlock::sortUpdate(\Yii::$app->user->id, $items);
        //todo make bad message if returned false
        //echo json_encode($items);
        \Yii::$app->end();
    }

}
