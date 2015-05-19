<?php

use yii\db\Schema;
use yii\db\Migration;

class m150407_115311_create_block_tables extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%block}}', [
            'id' => Schema::TYPE_PK,
            'column' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 1',
            'order' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 1',
            'title' => Schema::TYPE_STRING . '(32) NOT NULL',
            'hidden' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

        $this->insert('{{%block}}', [
            'column' => '1',
            'order' => '1',
            'title' => 'Test block',
            'hidden' => '0',
            'created_at' => time(),
            'updated_at' => time(),
        ]);

        $this->createTable('{{%link}}', [
            'id' => Schema::TYPE_PK,
            'block_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'order' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 1',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 1',
            'title' => Schema::TYPE_STRING . '(64) NOT NULL',
            'href' => Schema::TYPE_STRING . '(128) NOT NULL',
            'icon' => Schema::TYPE_STRING . '(32) NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'FOREIGN KEY (block_id) REFERENCES {{%block}} (id) ON DELETE CASCADE ON UPDATE CASCADE'
        ], $tableOptions);

        $this->insert('{{%link}}', [
            'block_id' => '1',
            'order' => '1',
            'title' => 'Test link, number 1',
            'href' => '#',
            'icon' => 'none',
            'created_at' => time(),
            'updated_at' => time(),
        ]);
        $this->insert('{{%link}}', [
            'block_id' => '1',
            'order' => '1',
            'title' => 'Test link, number 2',
            'href' => '#',
            'icon' => 'none',
            'created_at' => time(),
            'updated_at' => time(),
        ]);

    }

    public function down()
    {
        $this->dropTable('{{%link}}');
        $this->dropTable('{{%block}}');
    }

}
