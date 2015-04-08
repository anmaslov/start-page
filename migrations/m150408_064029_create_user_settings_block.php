<?php

use yii\db\Schema;
use yii\db\Migration;

class m150408_064029_create_user_settings_block extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user_settings_block}}', [
            'id' => Schema::TYPE_PK,
            'user_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'block_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'column' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 1',
            'order' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 1',
            'hidden' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 1',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'FOREIGN KEY (user_id) REFERENCES {{%user}} (id) ON DELETE CASCADE ON UPDATE CASCADE',
            'FOREIGN KEY (block_id) REFERENCES {{%block}} (id) ON DELETE CASCADE ON UPDATE CASCADE'
        ], $tableOptions);

        //$this->createIndex('idx_user_settings_block_usr', '{{%user_settings_block}}', 'user_id');
    }

    public function down()
    {
        $this->dropTable('{{%user_settings_block}}');
    }

}
