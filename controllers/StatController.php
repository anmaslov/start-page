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
            ->groupBy('block_id');

        $this->genDataJson($query);
    }

    /***
     * @param bool $year
     * @param bool $month
     * Count link clicked group by date
     */
    public function actionLinkStatByDate($year = false, $month = false)
    {
        $query = new Query();
        $query->select(["DATE_FORMAT(created_at, '%d.%m') as name", 'COUNT(*) AS cnt'])
            ->from('{{%link_stats}}')
            ->where('YEAR(created_at) = ' . (!$year ? date('Y') : $year))
            ->where('MONTH(created_at) = ' . (!$month ? date('m') : $month))
            ->groupBy(["DATE_FORMAT(created_at, '%Y%m%d')"])
            ->orderBy('name');

        $this->genDataJson($query);
    }

    public function actionTest()
    {
        return $this->render('test');
    }

    public function actionLinkList()
    {
        $data = Link::find()->all();

        $out = [];
        foreach ($data as $d) {
            $out[] = [
                'name' => $d->title,
                'lang' => $d->title
            ];
        }

        //echo Json::encode($out);

        echo '[
  {
    "name": "typeahead.js",
    "description": "A fast and fully-featured autocomplete library",
    "language": "JavaScript",
    "value": "typeahead.js",
    "tokens": [
      "typeahead.js",
      "JavaScript"
    ]
  },
  {
    "name": "cassandra",
    "description": "A Ruby client for the Cassandra distributed database",
    "language": "Ruby",
    "value": "cassandra",
    "tokens": [
      "cassandra",
      "Ruby"
    ]
  },
  {
    "name": "hadoop-lzo",
    "description": "Refactored version of code.google.com/hadoop-gpl-compression for hadoop 0.20",
    "language": "Shell",
    "value": "hadoop-lzo",
    "tokens": [
      "hadoop",
      "lzo",
      "Shell",
      "hadoop-lzo"
    ]
  },
  {
    "name": "scribe",
    "description": "A Ruby client library for Scribe",
    "language": "Ruby",
    "value": "scribe",
    "tokens": [
      "scribe",
      "Ruby"
    ]
  }
  ]';
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
