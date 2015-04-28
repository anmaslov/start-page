<?php

use yii\db\Schema;
use yii\db\Migration;

class m150428_141042_alter_table_link extends Migration
{
    public function up()
    {
        $this->addColumn('{{%link}}', 'tooltip', Schema::TYPE_STRING  .'(128) NULL');
    }

    public function down()
    {
        $this->dropColumn('{{%link}}', 'tooltip');
    }

}
