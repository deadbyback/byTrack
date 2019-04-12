<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%priority_name}}".
 *
 * @property int $priority_id
 * @property string $name
 *
 * @property BugReport[] $bugReports
 */
class PriorityName extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%priority_name}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['priority_id', 'name'], 'required'],
            [['priority_id'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['priority_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'priority_id' => Yii::t('app', 'Priority ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBugReports()
    {
        return $this->hasMany(BugReport::className(), ['priority' => 'priority_id']);
    }

    /**
     * {@inheritdoc}
     * @return PriorityNameQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PriorityNameQuery(get_called_class());
    }
}
