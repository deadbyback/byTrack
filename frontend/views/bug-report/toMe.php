<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = Yii::t('app', 'Bug Reports addressed to me');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bug Reports'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Welcome,ID: <?= Yii::$app->user->id ?></h1>
<div class="bug-report-to-me">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Go back'), 'javascript:history.back()', ['class' => 'btn btn-info']) ?>
    </p>

    <?=
    /** @var  $dataProvider frontend\controllers\BugReportController */
    /** @var $searchModel frontend\controllers\BugReportController*/
    GridView::widget([
        'filterModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'columns' =>[
            ['class' => 'yii\grid\SerialColumn'],
            'bug_id',
            'title',
            [
                'attribute' => 'description',
                'format' => 'ntext',
                'contentOptions' => ['style' => 'width:150px;  max-width:300px; overflow: hidden; max-height: 500px;
                  height: 50px; max-height: 200px;'],
            ],
            [
                'attribute' => 'playback_steps',
                'format' => 'ntext',
                'contentOptions' => ['style' => 'width:100px;  max-width:200px; overflow: hidden; height: 50px;
                  max-height: 200px;'],
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
                'contentOptions' => function ($model, $key, $index, $grid) {
                    if ($model->severity == 1) {$rv = 'danger';}
                    elseif ($model->severity == 2) {$rv = 'warning';}
                    elseif ($model->severity == 3) {$rv = 'info';}
                    elseif ($model->severity == 4) {$rv = 'success';}
                    else {$rv = '';}
                    return ['class' => $rv];
                }
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
                'contentOptions' => function ($model, $key, $index, $grid) {
                    if ($model->priority == 1) {$rv = 'danger';}
                    elseif ($model->priority == 2) {$rv = 'warning';}
                    else {$rv = 'success';}
                    return ['class' => $rv];
                }
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
                'contentOptions' => function ($model, $key, $index, $grid) {
                    if ($model->status == 1) {$rv = 'warning';}
                    elseif ($model->status == 2) {$rv = 'danger';}
                    elseif ($model->status == 3) {$rv = 'info';}
                    elseif ($model->status == 4) {$rv = 'success';}
                    elseif ($model->status == 5) {$rv = 'warning';}
                    else {$rv='info';}
                    return ['class' => $rv];
                }
            ],
            [
                'attribute' => 'reporter_id',
                'format' => 'raw',
                'value' => 'reporter.username',
                'contentOptions' => function ($model, $key, $index, $grid) {
                    if ($model->destination_id == Yii::$app->user->id) {$rv = 'success';}
                    else {$rv='';}
                    return ['class' => $rv];
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update}',
            ],
        ],
    ]); ?>
</div>