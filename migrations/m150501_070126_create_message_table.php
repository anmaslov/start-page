<?php

use yii\db\Schema;
use yii\db\Migration;

class m150501_070126_create_message_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%message}}', [
            'id' => Schema::TYPE_PK,
            'user' => Schema::TYPE_INTEGER . ' NOT NULL',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 1',
            'title' => Schema::TYPE_STRING  .'(255) NULL',
            'text' => Schema::TYPE_TEXT . ' NOT NULL',
            'state' => Schema::TYPE_STRING  .'(64) NOT NULL DEFAULT "default"',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

        $this->addForeignKey("fk_message_user", "{{%message}}", "user", "{{%user}}", "id", 'CASCADE', 'CASCADE');
        $this->addForeignKey("fk_message_state", "{{%message}}", "state", "{{%state}}", "name", 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_message_user', '{{%message}}');
        $this->dropForeignKey('fk_message_state', '{{%message}}');

        $this->dropTable('{{%message}}');
    }

}
