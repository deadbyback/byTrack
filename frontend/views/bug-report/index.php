<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

//use app\common\widgets\BackUrl;

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
        <!---/*Html::a(Yii::t('app', '<-- Go Back'), BackUrl::widget(), ['class' => 'btn btn-danger'])* -->
    </p>
<?php
if (Yii::$app->user->can('manager')){
    $template = '{view} {update}';
} elseif (Yii::$app->user->can('admin')) {
    $template = '{view} {update} {delete}';
} else {
    $template = '{view}';
}
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
                'format' => 'text',
                'filter' => [
                    1 => 'High',
                    2 => 'Medium',
                    3 => 'Low',
                ],
                'value' => 'priorityName.name'
            ],
            [
                'attribute' => 'status',
                'format' => 'text',
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
                'format' => 'text',
                'value' => 'reporter.username',
            ],
            [
                'attribute' => 'destination_id',
                'format' => 'text',
                'value' => 'destination.username',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>$template,
                'buttons' => [
                    'update' => function ($url, $model) {
                    return $model->reporter_id == Yii::$app->user->id
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
