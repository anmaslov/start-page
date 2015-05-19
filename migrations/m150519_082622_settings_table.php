<?php

use yii\db\Schema;
use yii\db\Migration;

class m150519_082622_settings_table extends Migration
{
    public function up()
    {
        $this->createTable(
            '{{%settings}}',
            [
                'id' => Schema::TYPE_PK,
                'type' => Schema::TYPE_STRING,
                'section' => Schema::TYPE_STRING,
                'key' => Schema::TYPE_STRING,
                'value' => Schema::TYPE_TEXT,
                'active' => Schema::TYPE_BOOLEAN,
                'created' => Schema::TYPE_DATETIME,
                'modified' => Schema::TYPE_DATETIME,
            ]
        );

        $this->insert('{{%settings}}', [
            'type' => 'string',
            'section' => 'brand',
            'key' => 'brand-img',
            'value' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAMAAAC7IEhfAAAA81BMVEX///9VPnxWPXxWPXxWPXxWPXxWPXxWPXz///9hSYT6+vuFc6BXPn37+vz8+/z9/f2LeqWMe6aOfqiTg6uXiK5bQ4BZQX9iS4VdRYFdRYJfSINuWI5vWY9xXJF0YJR3Y5Z4ZZd5ZZd6Z5h9apq0qcW1qsW1q8a6sMqpnLyrn76tocCvpMGwpMJoUoprVYxeRoJjS4abjLGilLemmbrDutDFvdLPx9nX0eDa1OLb1uPd1+Td2OXe2eXh3Ofj3+nk4Orl4evp5u7u7PLv7fPx7/T08vb08/f19Pf29Pj39vn6+fuEcZ9YP35aQn/8/P1ZQH5fR4PINAOdAAAAB3RSTlMAIWWOw/P002ipnAAAAPhJREFUeF6NldWOhEAUBRvtRsfdfd3d3e3/v2ZPmGSWZNPDqScqqaSBSy4CGJbtSi2ubRkiwXRkBo6ZdJIApeEwoWMIS1JYwuZCW7hc6ApJkgrr+T/eW1V9uKXS5I5GXAjW2VAV9KFfSfgJpk+w4yXhwoqwl5AIGwp4RPgdK3XNHD2ETYiwe6nUa18f5jYSxle4vulw7/EtoCdzvqkPv3bn7M0eYbc7xFPXzqCrRCgH0Hsm/IjgTSb04W0i7EGjz+xw+wR6oZ1MnJ9TWrtToEx+4QfcZJ5X6tnhw+nhvqebdVhZUJX/oFcKvaTotUcvUnY188ue/n38AunzPPE8yg7bAAAAAElFTkSuQmCC',
            'active' => 1
        ]);

        $this->insert('{{%settings}}', [
            'type' => 'string',
            'section' => 'brand',
            'key' => 'brand-text',
            'value' => 'Start-page',
            'active' => 1
        ]);

        $this->insert('{{%settings}}', [
            'type' => 'string',
            'section' => 'brand',
            'key' => 'brand-sub-text',
            'value' => 'Start-page sub text',
            'active' => 1
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%settings}}');
    }

}
