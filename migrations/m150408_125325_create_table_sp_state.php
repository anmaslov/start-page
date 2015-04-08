<?php

use yii\db\Schema;
use yii\db\Migration;

class m150408_125325_create_table_sp_state extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%state}}', [
            'name' => Schema::TYPE_STRING . '(64) NOT NULL',
            'title' => Schema::TYPE_STRING . '(64) NOT NULL',
            'created_at' => Schema::TYPE_INTEGER,
            'updated_at' => Schema::TYPE_INTEGER,
            'PRIMARY KEY (name)',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%state}}');
    }

}
