<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%work_history}}`.
 */
class m190613_111513_create_work_history_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%work_history}}', [
            'id' => $this->primaryKey(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%work_history}}');
    }
}
