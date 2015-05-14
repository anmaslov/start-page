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
        $query->select(['style as name', 'COUNT(*) AS cnt'])
            ->from('{{%user}}')->groupBy('style');
            //->orderBy('cnt');
        $this->genDataJson($query);
    }

    public function actionBlock()
    {
        $query = new Query();
        $query->select(['{{%block}}.title as name', 'COUNT(*) AS cnt'])
            ->from('{{%link}}')
            ->innerJoin('{{%block}}', '{{%link}}.block_id={{%block}}.id')
            ->groupBy('block_id');

        $this->genDataJson($query);
    }

    protected function genDataJson($query)
    {
        foreach($query->all() as $st){
            $sta[] = [
                'name' => $st['name'],
                'y' => (int)$st['cnt']
            ];
        }
        echo json_encode($sta);

        \Yii::$app->end();
    }
}
