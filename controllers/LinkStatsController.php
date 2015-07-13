<?php

namespace app\controllers;

use Yii;
use app\models\Link;
use app\models\LinkStats;
use app\models\User;
use yii\web\NotFoundHttpException;

class LinkStatsController extends \yii\web\Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    /***
     * go to link stat
     */
    public function actionGo($id)
    {
        User::loginGuest();

        if (($link = Link::findOne($id)) !== null) {
            if (LinkStats::create($id) === true){
                $this->redirect($link->href);
            } else {
                throw new NotFoundHttpException('Запрошеная страница не найдена.');
            }

        } else {
            throw new NotFoundHttpException('Запрошеная страница не найдена.');
        }

    }

}
