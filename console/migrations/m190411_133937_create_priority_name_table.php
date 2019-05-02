<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%priority_name}}`.
 */
class m190411_133937_create_priority_name_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%priority_name}}', [
            'priority_id' => $this->primaryKey(),
        ]);
        $this->addForeignKey('FK_priority_bug_report', '{{%priority_name}}', 'priority_id', '{{%bug_report}}', 'severity');

        $this->insert('{{%priority_name}}', [
            'priority_id' => '1',
            'name' => 'High',
        ]);
        $this->insert('{{%priority_name}}', [
            'priority_id' => '2',
            'name' => 'Medium',
        ]);
        $this->insert('{{%priority_name}}', [
            'priority_id' => '3',
            'name' => 'Low',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('{{%priority_name}}');
        $this->dropForeignKey('FK_status_bug_report', '{{%priority_name}}');
        $this->dropTable('{{%priority_name}}');
    }
}
