<?php

use yii\db\Schema;
use yii\db\Migration;

class m150421_073422_create_styles_table extends Migration
{
    public function getStyles()
    {
        return  [
            'default', 'paper', 'superhero', 'yeti', 'darkly', 'lumen', 'simplex', 'united', 'slate',
        ];
    }

    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%style}}', [
            'name' => Schema::TYPE_STRING . '(64) NOT NULL',
            'title' => Schema::TYPE_STRING . '(64) NOT NULL',
            'img' => Schema::TYPE_STRING . '(128) NULL',
            'PRIMARY KEY (name)',
        ], $tableOptions);

        foreach($this->getStyles() as $style){
            $this->insert('{{%style}}', [
                'name' => $style,
                'title' => $style,
            ]);
        }

        $this->addColumn('{{%user}}', 'style', Schema::TYPE_STRING  .'(64) NOT NULL DEFAULT "default"');
        $this->addForeignKey("fk_user_style", "{{%user}}", "style", "{{%style}}", "name");
    }

    public function down()
    {
        $this->dropForeignKey('fk_user_style', '{{%user}}');
        $this->dropColumn('{{%user}}', 'style');

        $this->dropTable('{{%style}}');
    }

}
