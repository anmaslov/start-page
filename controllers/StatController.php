<?php

namespace app\controllers;

use app\models\User;

class StatController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionStyle()
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
}
