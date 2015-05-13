<?php

namespace app\controllers;

class LinkStatsController extends \yii\web\Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }



    public function actionGo()
    {
        echo "переход по ссылке!";
    }

}
