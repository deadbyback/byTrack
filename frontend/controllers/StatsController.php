<?php

namespace frontend\controllers;

use common\models\BugReport;
use common\models\Project;
use common\models\ProjectParticipants;
use common\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use frontend\models\Stats;

class StatsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    public function actionDashboard()
    {
        return $this->render('dashboard');
    }

    public function actionGraph()
    {
        return $this->render('graph');
    }

    public function actionProject()
    {
        $projectCount = Project::find()->count();
        $projectMembersCount = ProjectParticipants::find()->select('user_id')->distinct()->count();
        $localProjectIds = Project::find()->select('id')->all();
        $localProjectTitles = Project::find()->select('title')->all();
        $localProjectMembersCount = ProjectParticipants::find()->select('project_id', count('user_id'))->distinct()->groupBy('project_id');
/*        var_dump($localProjectIds);
        var_dump($localProjectMembersCount);
        var_dump($projectMembersCount);
        var_dump($projectCount); die();*/
        return $this->render('project',
            ['projectCount' => $projectCount,
            'projectMembersCount' => $projectMembersCount,
            'localProjectIds' => $localProjectIds,
            'localProjectTitles' => $localProjectTitles,
            'localProjectMembersCount' => $localProjectMembersCount,]
        );
    }

    public function actionStatus()
    {
        $statusValues = array();
        for ($i = 1; $i < 7; $i++ )
        {
            $statusCount = BugReport::find()
                ->andWhere('status = :i', [':i' => $i])
                ->count();
            var_dump($statusCount);
            $statusValues[] = $statusCount;
        }
        var_dump($statusValues);
        return $this->render(['status', 'statusValues' => $statusValues]);
    }

    public function actionSeverity()
    {
        $severityValues = array();
        for ($i = 1; $i < 6; $i++ )
        {
            $severityCount = BugReport::find()
                ->andWhere('severity = :i', [':i' => $i])
                ->count();
            var_dump($severityCount);
            $severityValues[] = $severityCount;
        }
        return $this->render(['severity', 'severityValues' => $severityValues]);
    }

    public function actionPriority()
    {
        $priorityValues = array();
        for ($i = 1; $i < 4; $i++ )
        {
            $priorityCount = BugReport::find()
                ->andWhere('priority = :i', [':i' => $i])
                ->count();
            $priorityValues[] = $priorityCount;
        }
        return $this->render(['priority', 'priorityValues' => $priorityValues]);
    }
    /*TODO: Реализовать запросы*/
    public function actionUserReport()
    {
        $username = User::find()->select('username')->all();
        //$userReportsCount = BugReport::find()->select('reporter_id', count('bug_id'))->distinct();
        $userId = User::find()->select('id')->all();
        $userReportersList = BugReport::find()->select(['title'])->count('title');
        $userReportersList->andWhere('reporter_id IN :id', [':id' => $userId])
        ->andWhere('destination_id IN :id', [':id' => $userId]);
        var_dump($this->asJson($userReportersList));
        //var_dump($userId);
        die();
        //return $this->render('user-report');
    }

    public function actionUserStats()
    {
        return $this->render('user-stats');
    }

}
