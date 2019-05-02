<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[StatusName]].
 *
 * @see StatusName
 */
class StatusNameQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return StatusName[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return StatusName|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
