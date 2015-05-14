<?php

namespace app\controllers;

use yii\db\Query;

class StatController extends \yii\web\Controller
{
    public function actionIndex()
    {

        $styles = User::find()
            ->select(['style', 'COUNT(*) AS cnt'])
            ->groupBy('style')
            ->all();

        foreach($styles as $st){
            $sta[] = [
                'name' => $st->style,
                'y' => (int)$st->cnt
            ];
        }

        return $this->render('index', ['st' => $sta]);
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
