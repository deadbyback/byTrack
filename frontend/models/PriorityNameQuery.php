<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[PriorityName]].
 *
 * @see PriorityName
 */
class PriorityNameQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PriorityName[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PriorityName|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
