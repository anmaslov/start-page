<?php

use yii\db\Schema;
use yii\db\Migration;

class m150403_085205_create_user_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => Schema::TYPE_PK,
            'username' => Schema::TYPE_STRING . ' NOT NULL',
            //'auth_key' => Schema::TYPE_STRING . '(32) NOT NULL',
            //'password_hash' => Schema::TYPE_STRING . ' NOT NULL',
            //'password_reset_token' => Schema::TYPE_STRING,
            //'email' => Schema::TYPE_STRING . ' NOT NULL',
            'ip' => Schema::TYPE_STRING . '(15) NOT NULL', //15

            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

        $this->createIndex('idx_user_ip', '{{%user}}', 'ip', true);
        $this->createIndex('idx_user_status', '{{%user}}', 'status');

        $this->insert('{{%user}}', [
            'username' => 'localhost',
            'ip' => '127.0.0.1',
            'created_at' => time(),
            'updated_at' => time(),
        ]);

    }


    public function down()
    {
        $this->dropTable('{{%user}}');
    }

}
