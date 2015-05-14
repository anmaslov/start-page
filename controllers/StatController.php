<?php

namespace app\controllers;

use yii\db\Query;

class StatController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionStyle()
    {
        $query = new Query();
        $query->select(['style', 'COUNT(*) AS cnt'])
            ->from('{{%user}}')->groupBy('style');
            //->orderBy('cnt');

        foreach($query->all() as $st){
            $sta[] = [
                'name' => $st['style'],
                'y' => (int)$st['cnt']
            ];
        }

        echo json_encode($sta);
        \Yii::$app->end();
    }
}
