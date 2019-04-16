<?php

namespace common\rules;

use yii\rbac\Rule;

class ReporterRule extends Rule {
    public $name = 'isReporter';

    /**
     * @param int|string $id
     * @param \yii\rbac\Item $item
     * @param array $params
     * @return bool
     */
    public function execute($user, $item, $params)
    {
        return isset($params['bugReport']) ? $params['bugReport']->createdBy == $user : false;
    }
}