<?php

use yii\db\Schema;
use yii\db\Migration;

class m150514_092249_alter_table_messages extends Migration
{
    public function up()
    {
        $this->addColumn('{{%message}}', 'date_start', Schema::TYPE_DATETIME . ' NULL');
        $this->addColumn('{{%message}}', 'date_end', Schema::TYPE_DATETIME . ' NULL');
        $this->addColumn('{{%message}}', 'ip_adr', Schema::TYPE_STRING . '(15) NULL');
        $this->addColumn('{{%message}}', 'hit', Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0');
    }

    public function down()
    {
        $this->dropColumn('{{%message}}', 'date_start');
        $this->dropColumn('{{%message}}', 'date_end');
        $this->dropColumn('{{%message}}', 'ip_adr');
        $this->dropColumn('{{%message}}', 'hit');
    }

}
