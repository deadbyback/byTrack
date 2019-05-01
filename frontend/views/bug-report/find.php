<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = Yii::t('app', 'My Own Bug Reports');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bug Reports'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Welcome,ID: <?= Yii::$app->user->id ?></h1>
<div class="bug-report-find">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Go back'), 'javascript:history.back()' , ['class' => 'btn btn-info']) ?>
    </p>

    <?=
    /** @var  $dataProvider frontend\controllers\BugReportController */
    /** @var $searchModel frontend\controllers\BugReportController*/
    GridView::widget([
        'filterModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'columns' =>[
        ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'bug_id',
                'label' => 'Bug ID'
            ],
            [
                'attribute' => 'title',
                'label' => Yii::t('app', 'Title')
            ],
            [
                 'attribute' => 'description',
                 'format' => 'ntext',
                 'contentOptions' => ['style' => 'width:150px;  max-width:300px; overflow: hidden; max-height: 500px;
                  height: 50px; max-height: 200px;'],
                'label' => Yii::t('app', 'Description')
             ],
            [
                 'attribute' => 'playback_steps',
                 'format' => 'ntext',
                 'contentOptions' => ['style' => 'width:100px;  max-width:200px; overflow: hidden; height: 50px;
                  max-height: 200px;'],
                'label' => Yii::t('app', 'Playback Steps')
             ],
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
                'value' => 'severityName.name',
                'label' => Yii::t('app', 'Severity')
            ],
            [
                'attribute' => 'priority',
                'format' => 'raw',
                'filter' => [
                    1 => 'High',
                    2 => 'Medium',
                    3 => 'Low',
                ],
                'value' => 'priorityName.name',
                'label' => Yii::t('app', 'Priority')
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
                'value' => 'statusName.name',
                'label' => Yii::t('app', 'Status')
            ],
            [
                'attribute' => 'destination_id',
                'format' => 'raw',
                'value' => 'destination.username',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update}',
            ],
        ],
        ]); ?>
</div>
