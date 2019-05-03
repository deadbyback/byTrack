<?php

use common\models\PriorityName;
use common\models\SeverityName;
use common\models\StatusName;
use common\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BugReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $user common\models\User*/

$this->title = Yii::t('app', 'Bug Reports');
$this->params['breadcrumbs'][] = $this->title;
?>

<h1>Welcome, <?= Yii::$app->user->identity->first_name ?> (ID: <?= Yii::$app->user->id ?>)</h1>
<div class="bug-report-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Bug Report'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'My Own Reports'), ['bug-report/find'], ['class' => 'btn btn-primary'])?>
        <?= Html::a(Yii::t('app', 'Reports To Me'), ['bug-report/to-me'], ['class' => 'btn btn-info'])?>
    </p>
<?php
if (Yii::$app->user->can('admin')) {
    $template = '{view} {update} {delete}';
} else {
    $template = '{view} {update}';
}

$severityQuery = SeverityName::find()->all();
$priorityQuery = PriorityName::find()->all();
$statusQuery = StatusName::find()->all();

$severityFilter = ArrayHelper::map($severityQuery,'severity_id','name');
$priorityFilter = ArrayHelper::map($priorityQuery,'priority_id','name');
$statusFilter = ArrayHelper::map($statusQuery,'status_id','name');
?>
    <?php  $this->render('_search', ['model' => $searchModel]); ?>
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options'=>['style' => 'white-space:nowrap; width:100%; ',],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'bug_id',
            'title',
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
                'format' => 'text',
                'value' => 'reporter.username',
                'filter' =>  ArrayHelper::map(User::find()->all(),'id','username'),
                'contentOptions' => function ($model, $key, $index, $grid) {
                    if ($model->reporter_id == Yii::$app->user->id) {$rv = 'success';}
                    else {$rv='';}
                    return ['class' => $rv];
                }
            ],
            [
                'attribute' => 'destination_id',
                'format' => 'text',
                'value' => 'destination.username',
                'filter' =>  ArrayHelper::map(User::find()->all(),'id','username'),
                'contentOptions' => function ($model, $key, $index, $grid) {
                    if ($model->destination_id == Yii::$app->user->id) {$rv = 'success';}
                    else {$rv='';}
                    return ['class' => $rv];
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => $template,
                'buttons' => [
                    'update' => function ($url, $model) {
                    return $model->reporter_id == Yii::$app->user->id || Yii::$app->user->can('admin')
                        ? Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                'title' => Yii::t('app', 'Update'), 'class' =>'btn btn-xs',
                            ]) : '';
                        }
                ]
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>

</div>
