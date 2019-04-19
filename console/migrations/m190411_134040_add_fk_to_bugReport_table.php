<?php

use yii\db\Migration;

/**
 * Class m190411_134040_add_fk_to_bugReport_table
 */
class m190411_134040_add_fk_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('FK_user_assignment', '{{%auth_assignment}}', 'user_id', '{{%user}}', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_user_assignment', '{{%auth_assignment}}');
    }
}