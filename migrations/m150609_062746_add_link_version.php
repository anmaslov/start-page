<?php

use yii\db\Schema;
use yii\db\Migration;

class m150609_062746_add_link_version extends Migration
{
    public function up()
    {
        $this->addColumn('{{%link}}', 'version', Schema::TYPE_STRING . '(10) NULL');
    }

    public function down()
    {
        $this->dropColumn('{{%link}}', 'version');
    }

}
