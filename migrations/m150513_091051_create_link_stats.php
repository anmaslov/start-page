<?php

use yii\db\Schema;
use yii\db\Migration;

class m150513_091051_create_link_stats extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%link_stats}}', [
            'id' => Schema::TYPE_PK,
            'link_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'userip' => Schema::TYPE_STRING . '(15) NULL',
            'userhost' => Schema::TYPE_STRING . '(150) NULL',
            'useragent' => Schema::TYPE_STRING . '(500) NULL',
            'created_at' => Schema::TYPE_DATETIME . ' NOT NULL',
            'FOREIGN KEY (link_id) REFERENCES {{%link}} (id) ON DELETE CASCADE ON UPDATE CASCADE',
            'FOREIGN KEY (user_id) REFERENCES {{%user}} (id) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);

        $this->createIndex('idx_link_stats_ip', '{{%link_stats}}', 'userip', false);
    }

    public function down()
    {
        $this->dropTable('{{%link_stats}}');
    }

}
