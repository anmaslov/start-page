<?php

use yii\db\Schema;
use yii\db\Migration;

class m150409_084500_alter_block_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->addColumn('{{%block}}', 'state', Schema::TYPE_STRING  .'(64) NOT NULL DEFAULT "default"');
        $this->addForeignKey("fk_block_state", "{{%block}}", "state", "{{%state}}", "name", 'CASCADE', 'CASCADE');

        $this->addColumn('{{%user_settings_block}}', 'state', Schema::TYPE_STRING  .'(64) NOT NULL DEFAULT "default"');
        $this->addForeignKey("fk_user_settings_block_state", "{{%user_settings_block}}", "state", "{{%state}}", "name", 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk_block_state', '{{%block}}');
        $this->dropColumn('{{%block}}', 'state');

        $this->dropForeignKey('fk_user_settings_block_state', '{{%user_settings_block}}');
        $this->dropColumn('{{%user_settings_block}}', 'state');
    }
    

}
