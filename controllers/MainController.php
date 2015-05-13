<?php

namespace app\controllers;

use app\models\UserSettingsBlock;
use app\models\Block;
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
                        'actions' => ['index', 'update'],
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
        $block = Block::find()->with('links')->where(['hidden' => Block::STATUS_SHOW, 'type' => Block::TYPE_TAB])
            ->orderBy('order')->all();

        $model = UserSettingsBlock::find()
            ->with('block')
            ->orderBy('column, order')
            ->where(['{{%user_settings_block}}.user_id' => $curUser])
            ->all();

        return $this->render('index', [
            'model' => $model,
            'blocks' => $block,
        ]);
    }

    /***
     * Update block information
     * @throws \yii\base\ExitException
     */
    public function actionUpdate()
    {
        $items = \Yii::$app->request->get('items');

        $state = UserSettingsBlock::sortUpdate(\Yii::$app->user->id, $items);

        if ($state){
            $out = [
                'msg' => 'Сохранение прошло успешно',
                'type' => 'success'
            ];
        }else{
            $out = [
                'msg' => 'Ошибка сохранения',
                'type' => 'danger'
            ];
        }

        echo json_encode($out);
        \Yii::$app->end();
    }

}
