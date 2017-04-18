<?php

use yii\db\Migration;

class m170418_131926_update_user_styles extends Migration
{

    public function getStyles()
    {
        return  [
            'night', 'light', 'dos',
        ];
    }

    public function insertStyles(){
        foreach($this->getStyles() as $style){
            $this->insert('{{%style}}', [
                'name' => $style,
                'title' => $style,
            ]);
        }
    }
    /***
     *  1. Update all user theme style to default
     *  2. Remove all themes from styles table
     *  3. Insert new themes in styles table
     */
    public function up()
    {
        //Update
        $this->update('{{%user}}',
            ['style' => 'default'],
            ['not', ['style' => 'default']]
        );

        //remove all items from styles table exclude default

        $this->delete('{{%style}}',
            ['not', ['name' => 'default']]);

        $this->insertStyles();
    }


    public function down()
    {
        echo "m170418_131926_update_user_styles cannot be reverted.\n";
        return false;
    }

}
