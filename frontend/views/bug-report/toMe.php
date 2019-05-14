<?php

use common\models\PriorityName;
use common\models\SeverityName;
use common\models\StatusName;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = Yii::t('app', 'Bug Reports addressed to me');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bug Reports'),
    'url' => Yii::$app->request->referrer];
$this->params['breadcrumbs'][] = $this->title;

$severityQuery = SeverityName::find()->all();
$priorityQuery = PriorityName::find()->all();
$statusQuery = StatusName::find()->all();

$severityFilter = ArrayHelper::map($severityQuery,'severity_id','name');
$priorityFilter = ArrayHelper::map($priorityQuery,'priority_id','name');
$statusFilter = ArrayHelper::map($statusQuery,'status_id','name');
?>
<h1>Welcome,ID: <?= Yii::$app->user->id ?></h1>
<div class="bug-report-to-me">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Go back'), Yii::$app->request->referrer, ['class' => 'btn btn-info']) ?>
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
                'format' => 'text',
                'filter' => $severityFilter,
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
                'format' => 'text',
                'filter' => $priorityFilter,
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
                'format' => 'text',
                'filter' => $statusFilter,
                'value' => 'statusName.name',
                'contentOptions' => function ($model, $key, $index, $grid) {
                    if ($model->status == 1) {$rv = '';}
                    elseif ($model->status == 2) {$rv = 'danger';}
                    elseif ($model->status == 3) {$rv = 'info';}
                    elseif ($model->status == 4) {$rv = 'success';}
                    elseif ($model->status == 5) {$rv = '';}
                    else {$rv='warning';}
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