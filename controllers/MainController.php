<?php

namespace app\controllers;

use Yii;
use app\models\Message;
use app\models\UserSettingsBlock;
use app\models\Block;
use app\models\Link;
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

        $msg = Message::find()->where(['status' => Message::STATUS_SHOW])->all();
        Message::updateAllCounters(['hit' => 1], ['status' => Message::STATUS_SHOW]);

        return $this->render('index', [
            'model' => $model,
            'blocks' => $block,
            'messages' => $msg,
            'link' => Link::getLinksBlocks()
        ]);
    }

    /***
     * Update block information
     * @throws \yii\base\ExitException
     */
    public function actionUpdate()
    {
        $items = Yii::$app->request->post('items');

        $state = UserSettingsBlock::sortUpdate(Yii::$app->user->id, $items);

        if ($state){
            $out = [
                'msg' => Yii::t('app', 'FLASH_SUCCESS_SAVE'),
                'type' => 'success'
            ];
        }else{
            $out = [
                'msg' => Yii::t('app', 'FLASH_ERROR_SAVE'),
                'type' => 'danger'
            ];
        }

        echo json_encode($out);
        Yii::$app->end();
    }

}
