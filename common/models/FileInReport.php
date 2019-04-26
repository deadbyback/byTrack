<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%file_in_report}}".
 *
 * @property int $id
 * @property int $file_id
 * @property int $bug_id
 *
 * @property BugReport $bug
 * @property File $file
 */
class FileInReport extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%file_in_report}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file_id', 'bug_id'], 'required'],
            [['file_id', 'bug_id'], 'integer'],
            [['bug_id'], 'exist', 'skipOnError' => true, 'targetClass' => BugReport::className(), 'targetAttribute' => ['bug_id' => 'bug_id']],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => File::className(), 'targetAttribute' => ['file_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'file_id' => 'File ID',
            'bug_id' => 'Bug ID',
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
    public function getFile()
    {
        return $this->hasOne(File::className(), ['id' => 'file_id']);
    }

    /**
     * {@inheritdoc}
     * @return FileInReportQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FileInReportQuery(get_called_class());
    }
}
