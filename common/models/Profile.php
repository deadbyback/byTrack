<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%profile}}".
 *
 * @property int $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $gender
 * @property string $avatar
 *
 * @property User $user
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%profile}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'first_name', 'last_name'], 'required'],
            [['user_id'], 'integer'],
            [['avatar'], 'string'],
            [['first_name', 'last_name', 'gender'], 'string', 'max' => 50],
            [['user_id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'gender' => 'Gender',
            'avatar' => 'Avatar',
        ];
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
     * @return ProfileQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProfileQuery(get_called_class());
    }

    public function saveImage($filename)
    {
        $this->avatar = $filename;
        return $this->save(false);
    }
/*Если картинка есть - выведем путь. Если нет - то no-image*/
    public function getImage()
    {
        return ($this->avatar) ? '/uploads/' . $this->avatar : '/no-image.png';
    }
}
