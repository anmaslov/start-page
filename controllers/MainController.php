<?php

namespace app\controllers;

use app\models\Block;
use app\models\Link;
use app\models\UserSettingsBlock;
use yii\helpers\Json;

class MainController extends \yii\web\Controller
{
    public function actionIndex()
    {
        UserSettingsBlock::sync(1); //todo return data model
        //$block = Block::find()->with('links')->where(['hidden' => Block::STATUS_SHOW])->all();

        $model = UserSettingsBlock::find()
            //->innerJoinWith('block')
            ->with('block')
            ->where(['{{%user_settings_block}}.user_id' => 1])
            ->all();

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionUpdate()
    {
        $items = \Yii::$app->request->get('items');
        echo json_encode($items);
        //Yii::app->end();

        //UserWidget::model()->sortUpdate(Yii::app()->user->id, $items);
        //   echo json_encode($items);
        //Yii::app()->end();
    }

}
