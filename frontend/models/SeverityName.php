<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "{{%severity_name}}".
 *
 * @property int $severity_id
 * @property string $name
 *
 * @property BugReport[] $bugReports
 */
class SeverityName extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%severity_name}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'severity_id' => Yii::t('app', 'Severity ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBugReports()
    {
        return $this->hasMany(BugReport::className(), ['severity' => 'severity_id']);
    }

    /**
     * {@inheritdoc}
     * @return SeverityNameQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SeverityNameQuery(get_called_class());
    }
}
