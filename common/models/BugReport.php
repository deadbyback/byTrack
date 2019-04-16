<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%bug_report}}".
 *
 * @property int $bug_id
 * @property string $title
 * @property string $desription
 * @property string $playback_steps
 * @property string $severity
 * @property string $priority
 * @property string $status
 * @property int $reporter_id
 * @property int $destination_id
 *
 * @property User $destination
 * @property User $reporter
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
            [['desription', 'playback_steps'], 'string'],
            [['reporter_id', 'destination_id'], 'integer'],
            [['title'], 'string', 'max' => 40],
            [['severity', 'priority', 'status'], 'string', 'max' => 16],
            [['destination_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['destination_id' => 'id']],
            [['reporter_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['reporter_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'bug_id' => Yii::t('app', 'Bug ID'),
            'title' => Yii::t('app', 'Title'),
            'desription' => Yii::t('app', 'Desription'),
            'playback_steps' => Yii::t('app', 'Playback Steps'),
            'severity' => Yii::t('app', 'Severity'),
            'priority' => Yii::t('app', 'Priority'),
            'status' => Yii::t('app', 'Status'),
            'reporter_id' => Yii::t('app', 'Reporter ID'),
            'destination_id' => Yii::t('app', 'Destination ID'),
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
    public function getReporter()
    {
        return $this->hasOne(User::className(), ['id' => 'reporter_id']);
    }

    public function getSeverityName()
    {
        return $this->hasOne(SeverityName::className(), ['severity_id' => 'severity']);
    }


    public function getStatusName()
    {
        return $this->hasOne(StatusName::className(), ['status_id' => 'status']);
    }

    public function getPriorityName()
    {
        return $this->hasOne(PriorityName::className(), ['priority_id' => 'priority']);
    }


    public function getAuthorId()
    {
        return Yii::$app->user->getId();
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
