<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yii\bootstrap\ButtonDropdown;

/* @var $this yii\web\View */
/* @var $model common\models\BugReport */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bug Reports'),
    'url' => ['bug-report/index', 'id' => $model->project_id]];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<h1>Welcome,ID: <?= Yii::$app->user->id ?></h1>
<?= Html::a(Yii::t('app', 'Go back'), ['bug-report/index', 'id' => $model->project_id], ['class' => 'btn btn-info']) ?>

<div class="bug-report-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>

    <?php 
    $key = $model->bug_id;
    if (Yii::$app->user->id == $model->reporter_id || Yii::$app->user->id == $model->destination_id) {
        echo ButtonDropdown::widget([
            'encodeLabel' => false,
            'label' => 'Actions',
            'dropdown' => [
                'encodeLabels' => false,
                'items' => [
                    [
                        'label' => Yii::t('app', 'Update'),
                        'url' => ['update', 'id' => $key],
                        'visible' => Yii::$app->user->can('manager'),
                    ],
                    [
                        'label' => Yii::t('app', 'Delete'),
                        'linkOptions' => [
                            'data' => [
                                'method' => 'post',
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                            ],
                        ],
                        'url' => ['delete', 'id' => $key],
                        'visible' => Yii::$app->user->can('admin'),
                    ],
                    [
                        'label' => Yii::t('app', 'Attach Files'),
                        'url' => ['bug-report/upload', 'id' => $key],
                        'visible' => (Yii::$app->user->id == $model->reporter_id || Yii::$app->user->id == $model->destination_id),
                    ],
                ],
                'options' => [
                    'class' => 'dropdown-menu-right',
                ],
            ],
            'options' => [
                'class' => 'btn btn-default',
                'style' => 'margin:5px; text-align: right',
            ],
            'split' => false,
        ]);
    if  ($model->status == 1 || $model->status == 5){
        echo Html::a(Yii::t('app', 'Start working'), ['bug-report/in-progress', 'id' => $key], [
                'class' => 'btn btn-info col-xs-2 col-md-2',
                'style' => 'margin:5px',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to start working with this bug report?'),
                ],]
        );}
    if  ($model->status == 2 || $model->status == 4 || $model->status == 6){
        echo Html::a(Yii::t('app', 'Reopen'), ['bug-report/reopen', 'id' => $key], [
                'class' => 'btn btn-warning col-xs-2 col-md-2',
                'style' => 'margin:5px',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to reopen this bug report?'),
                ],]
        );}
    if  ($model->status == 3){
        echo Html::a(Yii::t('app', 'Get test it'), ['bug-report/in-q-a', 'id' => $key], [
                'class' => 'btn btn-info col-xs-2 col-md-2',
                'style' => 'margin:5px',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to send this bug report in QA?'),
                ],]
        );}
    if  ($model->status == 1 || $model->status == 3 || $model->status == 6){
        echo Html::a(Yii::t('app', 'Resolve'), ['bug-report/resolve', 'id' => $key], [
                'class' => 'btn btn-success col-xs-2 col-md-2',
                'style' => 'margin:5px',
                'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to resolve this bug report?'),
            ],]
    );}
    if  ($model->status == 1 || $model->status == 3 || $model->status == 4 || $model->status == 5){
        echo Html::a(Yii::t('app', 'Finish him'), ['bug-report/close', 'id' => $key], [
                'class' => 'btn btn-danger col-xs-2 col-md-2',
                'style' => 'margin:5px',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to finish this bug report?'),
                ],]
        );}
    }
    ?>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'bug_id',
            'title',
            [
                'attribute' => 'description',
                'label' => 'Description',
                'format' => 'ntext',
                'options' => ['style' => 'width:900px; overflow:hidden;']
            ],
            'playback_steps:ntext',
            [
                'attribute' => 'severityName.name',
                'label' => 'Severity'
            ],
            [
                'attribute' => 'priorityName.name',
                'label' => 'Priority'
            ],
            [
                'attribute' => 'statusName.name',
                'label' => 'Status'
            ],
            [
                'attribute' => 'reporter.username',
                'label' => 'Reporter'
            ],
            [
                'attribute' => 'destination.username',
                'label' => 'Destination'
            ],
        ],
    ]) ?>
<hr>
    <h2>Attached files</h2>
    <?php Pjax::begin();?>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
                'filename',
            'created',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete} {download}',
                'buttons' => [
                  'download' => function ($url, $model, $key) {
                      return Html::a('<span class="glyphicon glyphicon-download-alt"></span>', ['bug-report/download', 'id' => $model->id], [
                          'title' => Yii::t('app', 'Download'), 'class' =>'btn btn-xs',
                          'data-method' => 'post',
                      ]);
                  },
                    'delete' => function ($url, $model, $key) {
                      return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['bug-report/delete-file', 'id' => $model->id], [
                          'title' => Yii::t('app', 'Delete'),]);
                    }
                ],
            ],
        ],
    ]) ?>
    <?php Pjax::end()?>
<style>

    table.detail-view td {
        max-width: 100%;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    th {
        width: 30%;
    }
    td{
        width: 70%;
    }
</style>
</div>
