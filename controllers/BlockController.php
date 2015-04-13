<?php

namespace app\controllers;

use app\models\Link;
use Yii;
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
            Yii::$app->getSession()->setFlash('danger', 'Сперва удалите все ссылки');
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            $this->findModel($id)->delete();

            Yii::$app->getSession()->setFlash('success', "Успешно удалено");
            return $this->redirect(['index']);
        }
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

}
