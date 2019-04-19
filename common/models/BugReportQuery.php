<?php

namespace common\models;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[BugReport]].
 *
 * @see BugReport
 */
class BugReportQuery extends ActiveQuery
{
    public function active()
    {
        return $this->andWhere('[[reporter_id]]=1');
    }

    public function bySeverity($id)
    {
        $this->where([severityName::tableName().'.severity_id' => $id]);
    }

    public function byPriority($id)
    {
        $this->where([PriorityName::tableName().'.priority_id' => $id]);
    }

    public function byStatus($id)
    {
        $this->where([StatusName::tableName().'.status_id' => $id]);
    }
    /**
     * {@inheritdoc}
     * @return BugReport[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return BugReport|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
