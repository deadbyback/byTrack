<?php

use yii\db\Migration;

/**
 * Class m190412_051203_alter_types_in_bug_report_table
 */
class m190412_051203_alter_types_in_bug_report_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%bug_report}}', 'severity', $this->integer()->notNull());
        $this->alterColumn('{{%bug_report}}', 'priority', $this->integer()->notNull());
        $this->alterColumn('{{%bug_report}}', 'status', $this->integer()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('{{%bug_report}}', 'severity', $this->string(16)->notNull());
        $this->alterColumn('{{%bug_report}}', 'priority', $this->string(16)->notNull());
        $this->alterColumn('{{%bug_report}}', 'status', $this->string(16)->notNull());
    }
}