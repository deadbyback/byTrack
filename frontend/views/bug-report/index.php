<?php

use yii\helpers\Html;
use yii\grid\GridView;
//use app\common\widgets\BackUrl;

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
        <?= Html::a(Yii::t('app', 'My Own Reports'), ['bug-report/find'], ['class' => 'btn btn-primary'])?>
        <?= Html::a(Yii::t('app', 'Reports To Me'), ['bug-report/to-me'], ['class' => 'btn btn-info'])?>
        <!---/*Html::a(Yii::t('app', '<-- Go Back'), BackUrl::widget(), ['class' => 'btn btn-danger'])* -->
    </p>

    <?php  $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options'=>['style' => 'white-space:nowrap; width:100%; ',],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'bug_id',
            'title',
            //'desription:ntext',
           /* [
                'attribute' => 'desription',
                'format' => 'ntext',
                'contentOptions' => ['style' => 'width:150px;  max-width:300px; overflow: hidden; max-height: 500px;
                 height: 50px; max-height: 200px;'],

            ],*/
           // 'playback_steps:ntext',
           /* [
                'attribute' => 'playback_steps',
                'format' => 'ntext',
                'contentOptions' => ['style' => 'width:100px;  max-width:200px; overflow: hidden; height: 50px;
                 max-height: 200px;'],

            ],*/
            [
                'attribute' => 'severity',
                'format' => 'raw',
                'filter' => [
                    1 => 'Blocker',
                    2 => 'Critical',
                    3 => 'Major',
                    4 => 'Minor',
                    5 => 'Trivial',
                ],
                'value' => 'severityName.name'
            ],
            [
                'attribute' => 'priority',
                'format' => 'raw',
                'filter' => [
                    1 => 'High',
                    2 => 'Medium',
                    3 => 'Low',
                ],
                'value' => 'priorityName.name'
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'filter' => [
                    1 => 'Open',
                    2 => 'Closed',
                    3 => 'In Progress',
                    4 => 'Resolved',
                    5 => 'Reopened',
                    6 => 'In QA',
                ],
                'value' => 'statusName.name'
            ],
            [
                'attribute' => 'reporter_id',
                'format' => 'raw',
                'value' => 'reporter.username',
            ],
            [
                'attribute' => 'destination_id',
                'format' => 'raw',
                'value' => 'destination.username',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view}',
            ],
        ],
    ]); ?>


</div>
