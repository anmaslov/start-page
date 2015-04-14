<?php

namespace app\controllers;

use app\models\Link;
use app\models\UserSettingsBlock;
use Yii;
use app\models\Block;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

class BlockController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['index', 'update'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['edit-user-block'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'update', 'create', 'delete'],
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $model = Block::find()->with('links')
        //->where(['hidden' => Block::STATUS_SHOW])
            ->all();

        return $this->render('index', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', "$model->title обновлен");
            return $this->redirect(['index']);
        } else {
            //$link_not = Link::find()->where(['!=', 'block_id', $model->id])->all();
            return $this->render('updateBlock', [
                'model' => $model,
            ]);
        }
    }

    public function actionCreate()
    {
        $model = new Block();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', "$model->title успешно создан");
            return $this->redirect(['index']);
        } else {

            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $linkCnt = Link::find()->where(['block_id' => $model->id])->count();

        if ($linkCnt) {
            Yii::$app->getSession()->setFlash('danger', "Сперва удалите все ссылки для $model->title");
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            $this->findModel($id)->delete();

            Yii::$app->getSession()->setFlash('success', "Успешно удалено");
            return $this->redirect(['index']);
        }
    }

    public function actionEditUserBlock($id)
    {
        $userModel = $this->findUserBlock($id);
        $model = Block::find()->with('links')->where(['id' => $userModel->block_id])->one();

        if ($userModel->load(Yii::$app->request->post()) && $userModel->save())
            Yii::$app->getSession()->setFlash('success', "$model->title обновлен");

        return $this->render('userSettings', [
            'userModel' => $userModel,
            'model' => $model,
        ]);
    }

    /**
     * Finds the Link model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Link the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Block::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findUserBlock($id)
    {
        $userId = \Yii::$app->user->id;
        $Id = (int)str_replace('item', '', $id);

        if (($model = UserSettingsBlock::find()->where(['user_id' => $userId, 'id' => $Id])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не найдена!');
        }
    }

}
