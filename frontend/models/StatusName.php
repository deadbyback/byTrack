<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%status_name}}".
 *
 * @property int $status_id
 * @property string $name
 *
 * @property BugReport[] $bugReports
 */
class StatusName extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%status_name}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status_id', 'name'], 'required'],
            [['status_id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['status_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'status_id' => Yii::t('app', 'Status ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBugReports()
    {
        return $this->hasMany(BugReport::className(), ['status' => 'status_id']);
    }

    /**
     * {@inheritdoc}
     * @return StatusNameQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StatusNameQuery(get_called_class());
    }
}
