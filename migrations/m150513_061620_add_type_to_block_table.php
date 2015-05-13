<?php

use yii\db\Schema;
use yii\db\Migration;

class m150513_061620_add_type_to_block_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%block}}', 'type', Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 0');
    }

    public function down()
    {
        $this->dropColumn('{{%block}}', 'type');
    }

}
