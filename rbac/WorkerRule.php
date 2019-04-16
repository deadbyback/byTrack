<?php

namespace app\rbac;

use yii\rbac\Rule;

class WorkerRule extends Rule
{
    public $name = 'isWorker';

    public function execute($user, $item, $params)
    {
        return isset($params['bugReport']) ? $params['bugReport']->createdBy == $user : false;
    }
    
}