<?php

namespace app\controllers;

use app\models\Link;
use yii\db\Query;
use yii\helpers\Json;

class StatController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    /***
     * Theme style by user
     */
    public function actionStyle()
    {
        $query = new Query();
        $query->select(['style as name', 'COUNT(*) AS cnt'])
            ->from('{{%user}}')->groupBy('style');
            //->orderBy('cnt');
        $this->genDataJson($query);
    }

    /***
     * Count link by block
     */
    public function actionBlock()
    {
        $query = new Query();
        $query->select(['{{%block}}.title as name', 'COUNT(*) AS cnt'])
            ->from('{{%link}}')
            ->innerJoin('{{%block}}', '{{%link}}.block_id={{%block}}.id')
            ->groupBy('block_id')
            ->orderBy('cnt desc');

        $this->genDataJson($query);
    }

    /***
     * @param int $days
     * Count link clicked group by date
     */
    public function actionLinkStatByDate($days = 30)
    {
        $query = new Query();
        $query->select(["DATE_FORMAT(created_at, '%d.%m') as name", 'COUNT(*) AS cnt'])
            ->from('{{%link_stats}}')
            ->where("created_at > DATE_SUB(now(), INTERVAL $days DAY)")
            ->groupBy(["DATE_FORMAT(created_at, '%Y%m%d')"])
            ->orderBy('id');

        $this->genDataJson($query);
    }

    /***
     * @param int $count
     * Top link per day
     */
    public function actionTopLinks($count = 15)
    {
        $query = new Query();
        $query->select(['title as name', 'COUNT(*) AS cnt'])
            ->from('{{%link_stats}}')
            ->innerJoin('{{%link}}', '{{%link_stats}}.link_id = {{%link}}.id')
            ->where(["DATE_FORMAT({{%link_stats}}.created_at, '%Y%m%d')" => date('Ymd')])
            ->groupBy('link_id')
            ->limit($count)
            ->orderBy('cnt desc');

        $this->genDataJson($query);
    }

    /***
     * Top block link by day
     */
    public function actionBlockLink()
    {
        $query = new Query();
        $query->select(['{{%block}}.title as name', 'COUNT(*) AS cnt'])
            ->from('{{%link_stats}}')
            ->innerJoin('{{%link}}', '{{%link_stats}}.link_id = {{%link}}.id')
            ->innerJoin('{{%block}}', '{{%link}}.block_id = {{%block}}.id')
            ->where(["DATE_FORMAT({{%link_stats}}.created_at, '%Y%m%d')" => date('Ymd')])
            ->groupBy('{{%block}}.title')
            ->orderBy('cnt desc');

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
