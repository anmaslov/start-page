<?php

use yii\db\Schema;
use yii\db\Migration;

class m161101_081015_create_index_stat_table extends Migration
{
    public function up()
    {
        $this->createIndex('idx_link_stats_created', '{{%link_stats}}', 'created_at', false);
    }

    public function down()
    {
        $this->dropIndex('idx_link_stats_created', '{{%link_stats}}');
    }

}
