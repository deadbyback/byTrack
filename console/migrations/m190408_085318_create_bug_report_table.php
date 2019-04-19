<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%bug_report}}`.
 */
class m190408_085318_create_bug_report_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%bug_report}}', [
            'bug_id' => $this->primaryKey(),
            'title' => $this->string(60)->notNull(),
            'description' => $this->text(),
            'playback_steps' => $this->text(),
            'severity' => $this->integer()->notNull(),
            'priority' => $this->integer()->notNull(),
            'status' => $this->integer()->notNull(),
            'reporter_id' => $this->integer()->notNull(),
            'destination_id' => $this->integer()->notNull(),
        ]);

        /*TODO: Реализовать в последующих миграциях ключи комментариев и прикреплённых файлов
                'comment_id' => $this->integer(),
                'file_id' => $this->integer(),*/

        $this->createIndex('IDX_reporter_id', '{{%bug_report}}', 'reporter_id');
        $this->createIndex('IDX_destination_id', '{{%bug_report}}', 'destination_id');

        $this->addForeignKey('FK_reporter_user', '{{%bug_report}}', 'reporter_id',
            '{{user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_destination_user', '{{%bug_report}}', 'destination_id',
            '{{user}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_destination_user', '{{%bug_report}}');
        $this->dropForeignKey('FK_reporter_user', '{{%bug_report}}');

        $this->dropIndex('IDX_destination_id', '{{%bug_report}}');
        $this->dropIndex('IDX_reporter_id', '{{%bug_report}}');

        $this->dropTable('{{%bug_report}}');
    }
}
