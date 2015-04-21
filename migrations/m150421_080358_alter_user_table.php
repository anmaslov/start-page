<?php

use yii\db\Schema;
use yii\db\Migration;

class m150421_080358_alter_user_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'fa', Schema::TYPE_STRING  .'(128) NULL');
        $this->addColumn('{{%user}}', 'im', Schema::TYPE_STRING  .'(128) NULL');
        $this->addColumn('{{%user}}', 'ot', Schema::TYPE_STRING  .'(128) NULL');
        $this->addColumn('{{%user}}', 'dr', Schema::TYPE_DATE );
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'dr');
        $this->dropColumn('{{%user}}', 'im');
        $this->dropColumn('{{%user}}', 'ot');
        $this->dropColumn('{{%user}}', 'fa');
    }

}
