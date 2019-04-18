<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\BugReport */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bug Reports'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<h1>Welcome, <?= Yii::$app->user->identity->first_name ?> (ID: <?= Yii::$app->user->id ?>)</h1>
<?= Html::a(Yii::t('app', 'Back to all reports'), ['index'], ['class' => 'btn btn-info']) ?>

<div class="bug-report-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
    <?php if(\Yii::$app->user->can('manager', ['reporter_id' => $model->reporter_id])):?>

        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->bug_id], ['class' => 'btn btn-primary']) ?>
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
            'description:ntext',
            'playback_steps:ntext',
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
                'value' => function() {return \common\models\SeverityName::tableName()->name;},
            ],
            [
                'attribute' => 'priority',
                'format' => 'raw',
                'filter' => [
                    1 => 'High',
                    2 => 'Medium',
                    3 => 'Low',
                ],
                //'value' => 'priorityName.name'
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
                //'value' => 'statusName.name'
            ],
            'reporter_id',
            'destination_id',
        ],
    ]) ?>

</div>
