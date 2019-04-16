<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%severity_name}}`.
 */
class m190411_133841_create_severity_name_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%severity_name}}', [
            'severity_id' => $this->primaryKey(),
            'name' => $this->string(),
        ]);

        $this->createIndex('IDX_severity_bug_report', '{{%severity_name}}', 'severity_id');

        $this->addForeignKey('FK_severity_bug', '{{%bug_report}}', 'severity', '{{%severity_name}}', 'severity_id');
        $this->addForeignKey('FK_severity_bug_report', '{{%severity_name}}', 'severity_id', '{{%bug_report}}', 'severity');


        $this->insert('{{%severity_name}}', [
            'severity_id' => '1',
            'name' => 'Blocker',
        ]);
        $this->insert('{{%severity_name}}', [
            'severity_id' => '2',
            'name' => 'Critical',
        ]);
        $this->insert('{{%severity_name}}', [
            'severity_id' => '3',
            'name' => 'Major',
        ]);
        $this->insert('{{%severity_name}}', [
            'severity_id' => '4',
            'name' => 'Minor',
        ]);
        $this->insert('{{%severity_name}}', [
            'severity_id' => '5',
            'name' => 'Trivial',
        ]);
        $this->insert('{{%severity_name}}', [
            'severity_id' => '6',
            'name' => 'Improvement',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('{{%severity_name}}');
        $this->dropForeignKey('FK_severity_bug_report', '{{%severity_name}}');
        $this->dropForeignKey('FK_severity_bug', '{{%bug_report}}');
        $this->dropIndex('IDX_severity_bug_report', '{{%severity_name}}');
        $this->dropTable('{{%severity_name}}');
    }
}
