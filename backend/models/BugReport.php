<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%bug_report}}".
 *
 * @property int $bug_id
 * @property string $title
 * @property string $description
 * @property string $playback_steps
 * @property int $severity
 * @property int $priority
 * @property int $status
 * @property int $reporter_id
 * @property int $destination_id
 *
 * @property User $destination
 * @property PriorityName $priority0
 * @property User $reporter
 * @property SeverityName $severity0
 * @property StatusName $status0
 */
class BugReport extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%bug_report}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'severity', 'priority', 'status', 'destination_id'], 'required'],
            [['description', 'playback_steps'], 'string'],
            [['severity', 'priority', 'status', 'reporter_id', 'destination_id'], 'integer'],
            [['title'], 'string', 'max' => 60],
            [['destination_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['destination_id' => 'id']],
            [['priority'], 'exist', 'skipOnError' => true, 'targetClass' => PriorityName::className(), 'targetAttribute' => ['priority' => 'priority_id']],
            [['reporter_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['reporter_id' => 'id']],
            [['severity'], 'exist', 'skipOnError' => true, 'targetClass' => SeverityName::className(), 'targetAttribute' => ['severity' => 'severity_id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => StatusName::className(), 'targetAttribute' => ['status' => 'status_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'bug_id' => 'Bug ID',
            'title' => 'Title',
            'description' => 'description',
            'playback_steps' => 'Playback Steps',
            'severity' => 'Severity',
            'priority' => 'Priority',
            'status' => 'Status',
            'reporter_id' => 'Reporter ID',
            'destination_id' => 'Destination ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDestination()
    {
        return $this->hasOne(User::className(), ['id' => 'destination_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPriority0()
    {
        return $this->hasOne(PriorityName::className(), ['priority_id' => 'priority']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReporter()
    {
        return $this->hasOne(User::className(), ['id' => 'reporter_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeverity0()
    {
        return $this->hasOne(SeverityName::className(), ['severity_id' => 'severity']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(StatusName::className(), ['status_id' => 'status']);
    }

    /**
     * {@inheritdoc}
     * @return BugReportQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BugReportQuery(get_called_class());
    }
}
