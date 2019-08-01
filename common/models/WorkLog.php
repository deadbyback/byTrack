<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%work_log}}".
 *
 * @property int $id
 * @property int $bug_id
 * @property int $user_id
 * @property int $work_time
 * @property string $updated_at
 *
 * @property BugReport $bug
 * @property User $user
 */
class WorkLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%work_log}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bug_id', 'user_id'], 'required'],
            [['bug_id', 'user_id', 'work_time'], 'integer'],
            [['updated_at'], 'safe'],
            [['bug_id'], 'exist', 'skipOnError' => true, 'targetClass' => BugReport::className(), 'targetAttribute' => ['bug_id' => 'bug_id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bug_id' => 'Bug ID',
            'user_id' => 'User ID',
            'work_time' => 'Work Time',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBug()
    {
        return $this->hasOne(BugReport::className(), ['bug_id' => 'bug_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return WorkLogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WorkLogQuery(get_called_class());
    }
}
