<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BugReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $user frontend\models\User*/

$this->title = Yii::t('app', 'Bug Reports');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bug-report-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Bug Report'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php  $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'bug_id',
            'title',
            'desription:ntext',
            'playback_steps:ntext',
            [
                'attribute' => 'severity',
                'format' => 'raw',
                'filter' => [
                    0 => 'Blocker',
                    1 => 'Critical',
                    2 => 'Major',
                    3 => 'Minor',
                    4 => 'Trivial',
                ],
                'value' => function ($i) {switch ($i) {
                    case 0: return 'Blocker'; break;
                    case 1: return 'Critical'; break;
                    case 2: return 'Major'; break;
                    case 3: return 'Minor'; break;
                    case 4: return 'Trivial'; break;
                }
                },
            ],
            [
                'attribute' => 'priority',
                'format' => 'raw',
                'filter' => [
                    0 => 'High',
                    1 => 'Medium',
                    2 => 'Low',
                ],
                'value' => function ($i) {switch ($i) {
                    case 0: return 'High'; break;
                    case 1: return 'Medium'; break;
                    case 2: return 'Low'; break;
                }
                },
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'filter' => [
                    0 => 'Open',
                    1 => 'Closed',
                    2 => 'In Progress',
                    3 => 'Resolved',
                    4 => 'Reopened',
                    5 => 'In QA',
                ],
                'value' => function ($i) {switch ($i) {
                    case 0: return 'Open'; break;
                    case 1: return 'Closed'; break;
                    case 2: return 'In Progress'; break;
                    case 3: return 'Resolved'; break;
                    case 4: return 'Reopened'; break;
                    case 5: return 'In QA'; break;
                }
                },
            ],
            [
                'attribute' => 'reporter_id',
                'format' => 'raw',
                'value' => function () {
                     return Yii::$app->user->getId();
                },
            ],
            'destination_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
