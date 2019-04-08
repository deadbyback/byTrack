<?php

use yii\db\Migration;

/**
 * Class m190408_100729_add_firstname_and_lastname_to_user_table
 */
class m190408_100729_add_first_name_and_last_name_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{user}}', 'first_name', $this->string(20)->notNull());
        $this->addColumn('{{user}}', 'last_name', $this->string(20)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{user}}', 'last_name');
        $this->dropColumn('{{user}}', 'first_name');
    }
}
