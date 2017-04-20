<?php

namespace app\controllers;

use app\models\Link;
use yii\db\Query;
use yii\helpers\Json;

class StatController extends \yii\web\Controller
{
    private $duration = 3600;

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
        $result = Link::getDb()->cache(function() use($days){
            $query = new Query();
            return $query->select(["DATE_FORMAT(created_at, '%d.%m') as name", 'COUNT(*) AS cnt'])
                ->from('{{%link_stats}}')
                ->where("created_at > DATE_SUB(now(), INTERVAL $days DAY)")
                ->groupBy(["DATE_FORMAT(created_at, '%Y%m%d')"])
                ->orderBy('id')->all();
        }, $this->duration);

        foreach($result as $st){
            $sta[] = [
                'name' => $st['name'],
                'y' => (int)$st['cnt'],
                'drilldown' => $st['name'],
            ];
        }

        $res = Link::getDb()->cache(function() use($days){
            $query = new Query();
            return $query->select(['title as name', "DATE_FORMAT({{%link_stats}}.created_at, '%d.%m') as dtcreate", 'COUNT(*) AS cnt'])
                ->from('{{%link_stats}}')
                ->innerJoin('{{%link}}', '{{%link_stats}}.link_id = {{%link}}.id')
                ->where("{{%link_stats}}.created_at > DATE_SUB(now(), INTERVAL $days DAY)")
                ->groupBy("title, dtcreate")
                ->orderBy('cnt desc')
                ->all();

        }, $this->duration);

        $drill = [];
        foreach($res as $st){
            $drill[$st['dtcreate']]['data'][] = [$st['name'], (int)$st['cnt']];
        }

        $drillArr = array();
        foreach($drill as $key=>$item){
            $drillArr[] = ['name' => $key, 'id' => $key, 'data' => $drill[$key]['data']];
        }

        echo json_encode(['dt' => $sta, 'drill' => $drillArr]);
        \Yii::$app->end();
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
            ->where(['between','{{%link_stats}}.created_at',
                date('Y-m-d')." 00:00:00",
                date('Y-m-d')." 23:59:59",
            ])
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
            //->where(["DATE_FORMAT({{%link_stats}}.created_at, '%Y%m%d')" => date('Ymd')])
            ->where(['between','{{%link_stats}}.created_at',
                date('Y-m-d')." 00:00:00",
                date('Y-m-d')." 23:59:59",
            ])
            ->groupBy('{{%block}}.title')
            ->orderBy('cnt desc');

        $this->genDataJson($query);
    }

    public function actionEveryMin($limit = 100)
    {
        if (!is_numeric($limit) || $limit<=0 || $limit > 100)
            $limit = 100;

        $query = new Query();
        $query->select([
            'SUBSTRING(sec_to_time(time_to_sec(created_at)- time_to_sec(created_at)%(5*60)), 1, 5) as name',
            'count(*) as cnt'
            ])
            ->from('{{%link_stats}}')
            ->where('created_at > DATE_SUB(now(), INTERVAL 12 HOUR)')
            ->groupBy('name')
            ->limit((int)$limit)
            ->orderBy('id desc');

        foreach($query->all() as $st){
            $sta[] = [
                'name' => $st['name'],
                'y' => (int)$st['cnt']
            ];
        }

        echo json_encode(array_reverse($sta));

        \Yii::$app->end();
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
