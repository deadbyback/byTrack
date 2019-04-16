<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%status_name}}`.
 */
class m190411_133948_create_status_name_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%status_name}}', [
            'status_id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);

        $this->addForeignKey('FK_status_bug_report', '{{%status_name}}', 'status_id', '{{%bug_report}}', 'status');

        $this->insert('{{%status_name}}', [
            'status_id' => '1',
            'name' => 'Open',
        ]);
        $this->insert('{{%status_name}}', [
            'status_id' => '2',
            'name' => 'Closed',
        ]);
        $this->insert('{{%status_name}}', [
            'status_id' => '3',
            'name' => 'In progress',
        ]);
        $this->insert('{{%status_name}}', [
            'status_id' => '4',
            'name' => 'Resolved',
        ]);
        $this->insert('{{%status_name}}', [
            'status_id' => '5',
            'name' => 'Reopened',
        ]);
        $this->insert('{{%status_name}}', [
            'status_id' => '6',
            'name' => 'In QA',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('{{%status_name}}');
        $this->dropForeignKey('FK_status_bug_report', '{{%status_name}}');
        $this->dropTable('{{%status_name}}');
    }
}
