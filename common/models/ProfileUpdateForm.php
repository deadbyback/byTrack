<?php

namespace common\models;

use common\models\User;
use yii\base\Model;
use yii\db\ActiveQuery;
use Yii;

/**
 * @property mixed user_id
 */
class ProfileUpdateForm extends Model
{
    public $id;

    /**
     * @var Profile
     */
    private $_user;

    public function __construct(Profile $user, $config = [])
    {
        $this->_user = $user;
        $this->id = $user->user_id;
        parent::__construct($config);
    }

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

    public function update()
    {
        if ($this->validate()) {
            $user = $this->_user;

            return $user->save();
        } else {
            return false;
        }
    }
}