<?php

use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\BugReport */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bug Reports'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<h1>Welcome,ID: <?= Yii::$app->user->id ?></h1>
<?= Html::a(Yii::t('app', 'Back to all reports'), ['index'], ['class' => 'btn btn-info']) ?>

<div class="bug-report-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
    <?php if(\Yii::$app->user->can('manager', ['reporter_id' => $model->reporter_id])):?>

        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->bug_id], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>


    <?php if (Yii::$app->user->id == $model->reporter_id): ?>
    <?= Html::a(Yii::t('app', 'Attach files'), ['bug-report/upload', 'id' => $model->bug_id], ['class' => 'btn btn-info'])?>
    <?php endif; ?>
    <?php if(\Yii::$app->user->can('admin')):?>

       <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->bug_id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
            'method' => 'post',
        ],
       ]) ?></p>
    <?php endif?>


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
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
                'file',
            'created',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
            ],
        ],

    ]) ?>
<style>
    table.detail-view {
        table-layout: fixed;
    }

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
