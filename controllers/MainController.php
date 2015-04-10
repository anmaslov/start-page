<?php

namespace app\controllers;

use app\models\Block;
use app\models\Link;
use app\models\UserSettingsBlock;
use yii\helpers\Json;

class MainController extends \yii\web\Controller
{
    /***
     * List of all blocks
     * @return string
     */
    public function actionIndex()
    {
        //todo add current user
        UserSettingsBlock::sync(1); //todo return data model
        //$block = Block::find()->with('links')->where(['hidden' => Block::STATUS_SHOW])->all();

        $model = UserSettingsBlock::find()
            //->innerJoinWith('block')
            ->with('block')
            ->orderBy('column, order')
            ->where(['{{%user_settings_block}}.user_id' => 1])
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
        UserSettingsBlock::sortUpdate(1, $items);
        //todo make bad message if returned false
        //echo json_encode($items);
        \Yii::$app->end();
    }

}
