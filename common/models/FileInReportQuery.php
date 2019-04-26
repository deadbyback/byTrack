<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[FileInReport]].
 *
 * @see FileInReport
 */
class FileInReportQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return FileInReport[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return FileInReport|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
