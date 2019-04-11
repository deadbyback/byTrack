<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\BugReport */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Bug Reports'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<p>
    <?= Html::a(Yii::t('app', 'Back to all reports'), ['index'], ['class' => 'btn btn-info']) ?>
</p>
<div class="bug-report-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <h1><?= Yii::$app->user->id ?></h1>
    <?php if(\Yii::$app->user->can('updateReport', ['reporter_id' => $model->reporter_id])):?>
    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->bug_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->bug_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php endif; ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
            'reporter_id',
            'destination_id',
        ],
    ]) ?>

</div>
