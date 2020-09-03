<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\BugReport;
use yii\db\ActiveRecord;
use yii\db\Query;

class Stats extends ActiveRecord {

    public $projectQ;
    public $statusQuery = 0;
    public $severityQuery;
    public $priorityQuery;
    public $userReportQuery;
    public $userStatsQuery;
    
/*     $projectQuery = BugReport::find()
    ->select('count('')')
    ->innerJoin('{{project_participants}}', '{{project_participants}}.[[project_id]] = {{project}}.[[id]]')
    ->where(); */
//$statusQuery
}